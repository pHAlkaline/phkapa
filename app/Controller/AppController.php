<?php

/**
 * Application controller
 *
 * This file is the base controller of all other controllers
 *
 * PHP version 5
 *
 * @category Controller
 * @package  pHKapa
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
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
        'Session', 
        'Acl', 
        'Maintenance', 
        'Notify', 
        'Auth' => array(
            'loginAction' => array('admin' => false, 'plugin' => false, 'controller' => 'users', 'action' => 'login')
            ),
        'DebugKit.Toolbar',
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
        $this->Auth->logoutRedirect = array('admin' => false, 'plugin' => false, 'controller' => 'pages', 'action' => 'display');
        $this->Auth->loginRedirect = array('admin' => false, 'plugin' => 'phkapa', 'controller' => 'query', 'action' => 'index');
        $this->Auth->allow('display', 'login', 'logout','edit_profile','secure','notifications');
        $this->Auth->authorize = array('Controller');
        $this->Auth->flash = array('key'=>'Auth','element' => 'error','params'=>array());
        $this->Auth->authenticate = array(  AuthComponent::ALL => array('userModel' => 'User', 'scope' => array("User.active" => 1)),'Form');


        if (isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') {
            $this->layout = 'admin';
        }
        
        if ($this->Session->read('User.language')){
            Configure::write('Config.language', $this->Session->read('User.language'));
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
        $this->set('unread_notifications',$this->Notify->countNotifications(AuthComponent::user('id')));
        
        $this->set('user_at_string', __n('User','Users',1) . ' ' . $this->Session->read('Auth.User.name') . ' @ ' . __('pHkapa'));
    
        // if is set layout for error , clear menuItems
        if ($this->_setErrorLayout()) {
            $menuItems = array();
            $this->set(compact('menuItems'));
            
        };
        
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

