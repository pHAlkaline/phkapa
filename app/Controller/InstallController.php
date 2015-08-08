<?php

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
     * Step 0: welcome
     *
     * A simple welcome message for the installer.
     *
     * @return void
     * @access public
     */
    public function index() {
        
    }
    
    /**
     * This method should be called on first time run after manual instalation
     *
     * @return void
     * @access public
     */
    public function secure() {

        // secure app with new salt/seed
        if (!$this->__setNewSaltSeed()){
            $this->redirect('/');
        }
        // update all user passwords with new salt/seed 
        if (!$this->__updatePasswords()){
            $this->redirect('/');
        }

        $token = uniqid();
        $this->Session->write('Install', array(
            'token' => $token
        ));
       
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
                $this->Flash->info(__('Unable to secure your application, your Config %s core.php file is not writable. Please check the permissions.', DS));
                $this->log('Unable to secure your application, your Config %s core.php file is not writable. Please check the permissions.', DS);
                return false;
            }
            Configure::write('Security.salt', $salt);
            Configure::write('Security.cipherSeed', $seed);
        }
        return true;
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

            $this->Flash->error(__('Unable to generate users password.'));
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


}
