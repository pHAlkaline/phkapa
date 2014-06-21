<?php

App::uses('File', 'Utility');

/**
 * Install controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  PHKAPA
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */
class InstallController extends AppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Install';

    /**
     * No models required
     *
     * @var array
     * @access public
     */
    public $uses = array();

    /**
     * Helpers
     *
     * @var array
     * @access public
     */
    public $helpers = array('Html', 'Form');

    /**
     * Default configuration
     *
     * @var array
     * @access public
     */
    public $defaultConfig = array(
        'name' => 'default',
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'phkapa',
        'schema' => null,
        'prefix' => null,
        'encoding' => 'UTF8',
        'port' => null,
    );
    
    /*
     * Default email configuration
     * 
     * @var array
     * @access public
     */
    public $defaultEmail = array(
        'email' => 'noreply@yourdomain.com',
        'name' => 'reply to',
        'subject' => 'PHKAPA Notification'
        );

    /**
     * beforeFilter
     *
     * @return void
     * @access public
     */
    public function beforeFilter() {
        $this->Components->unload('Notify');
        parent::beforeFilter();
        $this->Auth->allow();
        
        //$this->layout = 'install';
    }
    
    /**
     * beforeRender callback
     *
     * @param  
     * @return 
     * @access public
     * @throws 
     */
    public function beforeRender() {}

    /**
     * If installed.txt exists, app is already installed
     *
     * @return void
     */
    protected function _check() {
        if (file_exists(TMP . 'installed.txt')) {
            $this->Session->setFlash(__('Already Installed'), 'flash_message_info');
            $this->redirect('/');
        }
    }

    /**
     * Step 0: welcome
     *
     * A simple welcome message for the installer.
     *
     * @return void
     * @access public
     */
    public function index() {
        $this->_check();
        $this->set('title_for_layout', __('Installation: Welcome'));
        $this->set('title_for_step', __('Installation: Welcome'));
    }

    /**
     * Step : database
     *
     * Try to connect to the database and give a message if that's not possible so the user can check their
     * credentials or create the missing database
     * Create the database file and insert the submitted details
     *
     * @return void
     * @access public
     */
    public function database() {
        $this->_check();
        $this->set('title_for_layout', __('Step 1 : Database connection'));
        $this->set('title_for_step', __('Step 1 : Database connection'));

        if (file_exists(APP . 'Config' . DS . 'database.php')) {
            $this->Session->setFlash(__('Database connection file already exists'), 'flash_message_info');
            $this->redirect(array('action' => 'data'));
        }

        if (empty($this->request->data)) {
            return;
        }

        App::uses('ConnectionManager', 'Model');
        $config = $this->defaultConfig;
        foreach ($this->request->data as $key => $value) {
            if (isset($config[$key])) {
                $config[$key] = $value;
            }
        }
        //print_r($config);
        //debug($this->request->data);
        try {
            ConnectionManager::create('default', $config);
            $db = ConnectionManager::getDataSource('default');
        } catch (MissingConnectionException $e) {

            $this->Session->setFlash(__('Could not connect to database: %s', $e->getMessage()), 'flash_message_info');
            return;
        }
        if (!$db->isConnected()) {
            $this->Session->setFlash(__('Could not connect to database.'), 'flash_message_info');
            return;
        }

        copy(APP . 'Config' . DS . 'database.php.install', APP . 'Config' . DS . 'database.php');
        $file = new File(APP . 'Config' . DS . 'database.php', true);
        $content = $file->read();

        foreach ($config as $configKey => $configValue) {
            $content = str_replace('{default_' . $configKey . '}', $configValue, $content);
        }

        if (!$file->write($content)) {
            $this->Session->setFlash(__('Could not write database.php file.'), 'flash_message_error');
            return;
        }
        return $this->redirect(array('action' => 'data'));
        
    }

    /**
     * Step : Run the initial sql scripts to create the db and seed it with data
     *
     * @return void
     * @access public
     */
    public function data() {
        $this->_check();
        $this->set('title_for_layout', __('Step 2 : Build database , load table values'));
        $this->set('title_for_step', __('Step 2 : Build database , load table values'));
        if (empty($this->request->data)) {
            return;
        }

        App::uses('File', 'Utility');
        App::uses('CakeSchema', 'Model');
        App::uses('ConnectionManager', 'Model');

        $db = ConnectionManager::getDataSource('default');
        $brokenSequence = $db instanceof Postgres;
        if (!$db->isConnected()) {
            $this->Session->setFlash(__('Could not connect to database.'), 'flash_message_error');
        } else {

            try {
                $this->__executeSQLScript($db, APP . 'Config' . DS . 'Schema' . DS . 'phkapa_structure.sql');
            } catch (MissingConnectionException $e) {

                $this->Session->setFlash(__('Could not load database: %s', $e->getMessage()), 'flash_message_info');
                return;
            }

            try {
                if ($this->request->data['demo_data'] == '1') {
                    $this->__executeSQLScript($db, APP . 'Config' . DS . 'Schema' . DS . 'phkapa_demo_data.sql');
                }
            } catch (MissingConnectionException $e) {

                $this->Session->setFlash(__('Could not load database: %s', $e->getMessage()), 'flash_message_info');
                return;
            }
        }


        $this->redirect(array('action' => 'email'));
    }

    function __executeSQLScript($db, $fileName) {
        $statements = file_get_contents($fileName);
        $statements = explode(';', $statements);

        foreach ($statements as $statement) {
            if (trim($statement) != '') {

                $db->query($statement);
            }
        }
    }

    private function __setNewSaltSeed() {
        // set new salt and seed value
        if (Configure::read('Security.salt') == 'zshlC2wMeCWMnRH8BmqmLQUFeBIT4uwBGSMS4k1w' || Configure::read('Security.cipherSeed') == '2973937642728344649949541921993430529846') {

            $File = & new File(APP . 'Config' . DS . 'core.php');
            $salt = Security::generateAuthKey();
            $seed = mt_rand() . mt_rand();
            $contents = $File->read();
            $contents = preg_replace('/(?<=Configure::write\(\'Security.salt\', \')([^\' ]+)(?=\'\))/', $salt, $contents);
            $contents = preg_replace('/(?<=Configure::write\(\'Security.cipherSeed\', \')(\d+)(?=\'\))/', $seed, $contents);
            if (!$File->write($contents)) {
                $this->Session->setFlash(__('Unable to secure your application, your Config %s core.php file is not writable. Please check the permissions.', DS), 'flash_message_info');
                $this->log('Unable to secure your application, your Config %s core.php file is not writable. Please check the permissions.', DS);
                return false;
            }
            Configure::write('Security.salt', $salt);
            Configure::write('Security.cipherSeed', $seed);
        }
        return true;
    }
    
    /**
     * Step : email
     *
     * Create the email file and insert the submitted details
     *
     * @return void
     * @access public
     */
    public function email() {
        $this->_check();
        $this->set('title_for_layout', __('Step 3 : Email notification'));
        $this->set('title_for_step', __('Step 3 : Email notification'));

        if (file_exists(APP . 'Config' . DS . 'email.php')) {
            $this->Session->setFlash(__('Email settings file already exists'), 'flash_message_info');
            $this->redirect(array('action' => 'adminuser'));
        }

        if (empty($this->request->data)) {
            return;
        }
        $config = $this->defaultEmail;
        foreach ($this->request->data as $key => $value) {
            if (isset($config[$key])) {
                $config[$key] = $value;
            }
        }
        copy(APP . 'Config' . DS . 'email.php.install', APP . 'Config' . DS . 'email.php');
        $file = new File(APP . 'Config' . DS . 'email.php', true);
        $content = $file->read();

        foreach ($config as $configKey => $configValue) {
            $content = str_replace('{default_' . $configKey . '}', $configValue, $content);
        }

        if (!$file->write($content)) {
            $this->Session->setFlash(__('Could not write email.php file.'), 'flash_message_error');
            return;
        }
        return $this->redirect(array('action' => 'adminuser'));
        
    }

    /**
     * Step : secure app and set new password for administrative user
     */
    public function adminuser() {
        $this->_check();
        $this->set('title_for_layout', __('Step 4 : Secure app and set new administrator password'));
        $this->set('title_for_step', __('Step 4 : Secure app and set new administrator password'));
        if (empty($this->request->data)) {
            return;
        }

        if ($this->request->is('post')) {
            // password and verify password must match
            // secure app
            if (!$this->__setNewSaltSeed())
                return;
            // update all user passwords with new salt/seed 
            if (!$this->__updatePasswords())
                return;

            // save new admin password
            $this->loadModel('User');
            $this->User->read(null, 1);
            $this->User->set($this->request->data);
            if ($this->User->save()) {
                $this->Session->setFlash(__('Saved with success.'), 'flash_message_info');
                $token = uniqid();
                $this->Session->write('Install', array(
                    'token' => $token
                ));
                $this->redirect(array('action' => 'finish', $token));
            } else {
                $this->Session->setFlash(__('Could not be saved. Please, try again.'), 'flash_message_error');
                $this->log(__('Unable to create administrative user.'));
                $this->log($this->User->validationErrors);
            }
        }
    }

    /**
     * Step 4: finish
     *
     * Copy instaled.txt file into place and create user obtained in step 3
     *
     * @return void
     * @access public
     */
    public function finish($token = null) {

        $this->_check();
        $this->set('title_for_layout', __('Installation completed successfully'));
        $this->set('title_for_step', __('Installation completed successfully'));
        $install = $this->Session->read('Install');
        if ($install['token'] == $token) {
            unset($install['token']);
            // Create a new file with 0644 permissions
            $file = new File(TMP . 'installed.txt', true, 0644);
            if ($file) {
                $file->append(__('Installation completed successfully'));
                $file->close();
                $this->Session->setFlash(__('Installation completed successfully'), 'flash_message_info');
            } else {
                $this->set('title_for_layout', __('Installation not completed successfully'));
                $this->set('title_for_step', __('Installation not completed successfully'));
                $this->Session->setFlash(__('Something went wrong during installation. Please check your server logs.'), 'flash_message_error');
                //$this->redirect(array('action' => 'adminuser'));
            }
            $this->Session->delete('Install');
        } else {
            //$this->redirect('/');
        }
    }

    /**
     * Step * : secure
     * This method should be called on first time run after manual instalation
     * Copy instaled.txt file into place , secure app, and set default password to all users
     * Default password equals username
     *
     * @return void
     * @access public
     */
    public function secure() {

        $this->_check();
        // password and verify password must match
        // secure app
        if (!$this->__setNewSaltSeed())
            return;
        // update all user passwords with new salt/seed 
        if (!$this->__updatePasswords())
            return;

        $token = uniqid();
        $this->Session->write('Install', array(
            'token' => $token
        ));
        $this->redirect(array('action' => 'finish', $token));
    }

    /**
     * Update Passwords
     *
     * Updates all users passwords with new salt value
     * Setting new password equals username 
     * @param $user
     * @return $mixed if false, indicates processing failure
     */
    private function __updatePasswords() {

        $this->loadModel('User');
        $users = $this->User->find('all');
        foreach ($users as $key => $user) {
            $users[$key]['User']['password'] = $users[$key]['User']['username'];
            //var_dump($users[$key]);
        }
        // update all users
        if (!$this->User->saveAll($users)) {

            $this->Session->setFlash(__('Unable to generate users password.'), 'flash_message_error');
            $this->log(__('Unable to generate users password.'));
            $this->log($User->validationErrors);
            return false;
        }
        return true;
    }

    /**
     * isAuthorized
     *
     * @param  user data array
     * @return boolean
     * @access public
     * @throws 
     */
    public function isAuthorized($user = null) {
        //echo "auth";
        $result = true;
        return $result;
    }

}
