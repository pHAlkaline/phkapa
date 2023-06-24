<?php

/**
 * Application controller
 *
 * This file is the base controller of all other controllers
 *
 * PHP version 7
 *
 * @category Controller
 * @package  pHKapa
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.net>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     https://phalkaline.net
 */
class AppController extends Controller {

    public $theme = "Phkapa";

    /**
     * Components
     *
     * @var array
     * @access public
     */
    public $components = array(
        'Paginator',
        'RequestHandler',
        'Flash',
        'Session', 'Cookie',
        'Acl',
        'Maintenance',
        'Notify',
        'Auth' => array(
            'loginAction' => array('admin' => false, 'plugin' => false, 'controller' => 'users', 'action' => 'login')
        ),
        'DebugKit.Toolbar' => array('panels' => array('ClearCache.ClearCache')),
    );

    /**
     * Helpers
     *
     * @var array
     * @access public
     */
    public $helpers = array('Time', 'Session', 'Flash', 'Html', 'Form', 'Utils');

    /**
     * beforeFilter
     *
     * @return void
     * @access public
     * @throws 
     */
    public function beforeFilter() {

        $this->Cookie->name = Configure::read('Cookie.name');
        if (!$this->Cookie->check('Config.language')) {
            $this->Cookie->write('Config.language', Configure::read('Language.default'));
        }
        Configure::write('Config.language', $this->Cookie->read('Config.language'));

        $this->Auth->logoutRedirect = array('admin' => false, 'plugin' => false, 'controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('plugin' => 'phkapa', 'controller' => 'query', 'action' => 'index');
        $this->Auth->allow('display', 'login', 'logout', 'edit_profile', 'notifications');
        $this->Auth->authorize = array('Controller');
        $this->Auth->flash = array('key' => 'Auth', 'element' => 'error', 'params' => array());
        $this->Auth->authenticate = array(AuthComponent::ALL => array('userModel' => 'User', 'scope' => array("User.active" => 1)), 'Form');

        if (isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') {
            $this->layout = 'admin';
        }
        $this->rememberMe();
    }

    private function rememberMe() {
        // set cookie options
        $this->Cookie->httpOnly = true;

        if (!$this->Auth->loggedIn() && $this->Cookie->read('rememberMe')) {
            $cookie = $this->Cookie->read('rememberMe');
            $user = false;
            if (isset($cookie['username']) && isset($cookie['password'])) {
                $this->loadModel('User'); // If the User model is not loaded already
                $user = $this->User->find('first', array(
                    'conditions' => array(
                        'User.username' => $cookie['username'],
                        'User.password' => $cookie['password']
                    )
                ));
            }

            if ($user && !$this->Auth->login($user['User'])) {
                Router::url(array('plugin' => 'phkapa', 'controller' => 'query', 'action' => 'index'), true); // destroy session & cookie
            }
        }
    }

    /**
     * isAuthorized
     *
     * @param  array user data
     * @return boolean
     * @access public
     * @throws 
     */
    public function isAuthorized($user = null) {
        if (Configure::read('Access.open') == 'All' || Configure::read('Access.open') == $user['name']) {
            return true;
        }
        return $this->Acl->check($user['name'], 'Total');
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
        $this->set('title_for_layout', '');
        $this->theme = Configure::read('Application.theme');
        $this->set('unread_notifications', $this->Notify->countNotifications(AuthComponent::user('id')));

        $this->set('user_at_string', __n('User', 'Users', 1) . ' ' . $this->Session->read('Auth.User.name') . ' @ ' . __('pHkapa'));

        // if is set layout for error , clear menuItems
        if ($this->_setErrorLayout()) {
            $menuItems = array();
            $this->set(compact('menuItems'));
        }
    }

    private function _setErrorLayout() {
        // Set layout
        if ($this->name == 'CakeError') {
            //$this->layout = 'error';
            return true;
        }
        return false;
    }

}
