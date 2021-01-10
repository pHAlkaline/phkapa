<?php

App::uses('File', 'Utility');

/**
 * Install controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  pHKapa
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.net>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */
class InstallController extends InstallAppController {

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
        'subject' => 'pHKapa Notification',
        'sender_email' => 'Your Site name',
        'host' => '',
        'port' => '',
        'username' => '',
        'password' => '',
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
    public function beforeRender() {
        $this->set('user_at_string', __d('install', 'Installation: Welcome'));
    
    }

    /**
     * If installed.txt exists, app is already installed
     *
     * @return void
     */
    protected function _check() {
        if (file_exists(TMP . 'installed.txt')) {
            $this->Flash->info(__d('install', 'Already Installed'));
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
        if (isset($this->data['Install']['language']) && $this->data['Install']['language'] != '') {
            $this->Session->write('User.language', $this->data['Install']['language']);
            $this->redirect(array('action' => 'index'));
        }
        $this->set('title_for_layout', __d('install', 'Installation: Welcome'));
        $this->set('title_for_step', __d('install', 'Installation: Welcome'));
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
        $this->set('title_for_layout', __d('install', 'Step 1 : Database connection'));
        $this->set('title_for_step', __d('install', 'Step 1 : Database connection'));

        if (file_exists(APP . 'Config' . DS . 'database.php')) {
            $this->Flash->info(__d('install', 'Database connection file already exists'));
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

        try {
            ConnectionManager::create('default', $config);
            $db = ConnectionManager::getDataSource('default');
        } catch (MissingConnectionException $e) {

            $this->Flash->info(__d('install', 'Could not connect to database: %s', $e->getMessage()));
            return;
        }
        if (!$db->isConnected()) {
            $this->Flash->error(__d('install', 'Could not connect to database.'));
            return;
        }

        copy(APP . 'Config' . DS . 'database.php.install', APP . 'Config' . DS . 'database.php');
        $file = new File(APP . 'Config' . DS . 'database.php', true);
        $content = $file->read();

        foreach ($config as $configKey => $configValue) {
            $content = str_replace('{default_' . $configKey . '}', $configValue, $content);
        }

        if (!$file->write($content)) {
            $this->Flash->error(__d('install', 'Could not write database.php file.'));
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
        $this->set('title_for_layout', __d('install', 'Step 2 : Build database , load table values'));
        $this->set('title_for_step', __d('install', 'Step 2 : Build database , load table values'));
        if (empty($this->request->data)) {
            return;
        }

        App::uses('File', 'Utility');
        App::uses('CakeSchema', 'Model');
        App::uses('ConnectionManager', 'Model');

        $db = ConnectionManager::getDataSource('default');
        $brokenSequence = $db instanceof Postgres;
        if (!$db->isConnected()) {
            $this->Flash->error(__d('install', 'Could not connect to database.'));
        } else {
            
            //phkapa structure
            $structure_file = APP . 'Config' . DS . 'Schema' . DS . 'phkapa_structure_' . Configure::read('Config.language') . '.sql';
            if (!file_exists($structure_file)) {
                $structure_file = APP . 'Config' . DS . 'Schema' . DS . 'phkapa_structure.sql';
            }
            try {
                $this->__executeSQLScript($db, $structure_file);
            } catch (MissingConnectionException $e) {

                $this->Flash->error(__d('install', 'Could not load database: %s', $e->getMessage()));
                return;
            }

            // phkapa demo data
            $demo_data_file = APP . 'Config' . DS . 'Schema' . DS . 'phkapa_demo_data_' . Configure::read('Config.language') . '.sql';
            if (!file_exists($demo_data_file)) {
                $demo_data_file = APP . 'Config' . DS . 'Schema' . DS . 'phkapa_demo_data.sql';
            }
            if ($this->request->data['demo_data'] == '1') {

                try {
                    $this->__executeSQLScript($db, $demo_data_file);
                } catch (MissingConnectionException $e) {

                    $this->Flash->error(__d('install', 'Could not load database: %s', $e->getMessage()));
                    return;
                }
            }

            // attachement plugin
            $attachment_file = APP . 'Plugin' . DS . 'Attachment' . DS . 'Config' . DS . 'Schema' . DS . 'attachment.sql';
            try {

                $this->__executeSQLScript($db, $attachment_file);
            } catch (MissingConnectionException $e) {

                $this->Flash->error(__d('install', 'Could not load database: %s', $e->getMessage()));
                return;
            }

            // feedback plugin
            $feedback_file = APP . 'Plugin' . DS . 'Feedback' . DS . 'Config' . DS . 'Schema' . DS . 'feedback.sql';
            try {
                $this->__executeSQLScript($db, $feedback_file);
            } catch (MissingConnectionException $e) {

                $this->Flash->error(__d('install', 'Could not load database: %s', $e->getMessage()));
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
        $File = new File(APP . 'Config' . DS . 'core.php');
        $salt = Security::generateAuthKey();
        $seed = mt_rand() . mt_rand();
        $contents = $File->read();
        $contents = preg_replace('/(?<=Configure::write\(\'Security.salt\', \')([^\' ]+)(?=\'\))/', $salt, $contents);
        $contents = preg_replace('/(?<=Configure::write\(\'Security.cipherSeed\', \')(\d+)(?=\'\))/', $seed, $contents);
        if (!$File->write($contents)) {
            $this->Flash->error(__d('install', 'Unable to secure your application, your Config %s core.php file is not writable. Please check the permissions.', DS));
            $this->log('Unable to secure your application, your Config %s core.php file is not writable. Please check the permissions.', DS);
            return false;
        }
        Configure::write('Security.salt', $salt);
        Configure::write('Security.cipherSeed', $seed);

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
        $this->set('title_for_layout', __d('install', 'Step 3 : Email notification'));
        $this->set('title_for_step', __d('install', 'Step 3 : Email notification'));

        if (file_exists(APP . 'Config' . DS . 'email.php')) {
            $this->Flash->info(__d('install', 'Email settings file already exists'));
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
            $this->Flash->error(__d('install', 'Could not write email.php file.'));
            return;
        }
        return $this->redirect(array('action' => 'adminuser'));
    }

    /**
     * Step : secure app and set new password for administrative user
     */
    public function adminuser() {
        $this->_check();
        $this->set('title_for_layout', __d('install', 'Step 4 : Secure app and set new administrator password'));
        $this->set('title_for_step', __d('install', 'Step 4 : Secure app and set new administrator password'));
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
                $this->Flash->info(__d('install', 'Saved with success.'));
                $token = uniqid();
                $this->Session->write('Install', array(
                    'token' => $token
                ));
                $this->redirect(array('action' => 'finish', $token));
            } else {
                $this->Flash->error(__d('install', 'Could not be saved. Please, try again.'));
                $this->log(__d('install', 'Unable to create administrative user.'));
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
        $this->set('title_for_layout', __d('install', 'Installation completed successfully'));
        $this->set('title_for_step', __d('install', 'Installation completed successfully'));
        $install = $this->Session->read('Install');
        if ($install['token'] == $token) {
            unset($install['token']);
            // Create a new file with 0644 permissions
            $file = new File(TMP . 'installed.txt', true, 0644);
            if ($file) {
                $file->append(__d('install', 'Installation completed successfully'));
                $file->close();
                $this->Flash->info(__d('install', 'Installation completed successfully'));
            } else {
                $this->set('title_for_layout', __d('install', 'Installation not completed successfully'));
                $this->set('title_for_step', __d('install', 'Installation not completed successfully'));
                $this->Flash->error(__d('install', 'Something went wrong during installation. Please check your server logs.'));
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

            $this->Flash->error(__d('install', 'Unable to generate users password.'));
            $this->log(__d('install', 'install', 'Unable to generate users password.'));
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
