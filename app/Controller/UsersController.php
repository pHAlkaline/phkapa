<?php

/**
 * Users controller
 *
 * PHP version 7
 *
 * @category Controller
 * @package  pHKapa
 * @version  V1.4
 * @author   Paulo Homem <contact@phalkaline.net>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */
class UsersController extends AppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Users';

    /**
     * Edit User Profile
     *
     * @return void
     * @access public
     */
    public function edit_profile() {
        if (!$this->Auth->loggedIn() || Configure::read('Application.mode') == 'demo') {
            $this->Flash->error(__('Invalid request.'));
            $this->redirect(Router::url('/', true));
        }

        $id = $this->Auth->user('id');

        if (!empty($this->request->data)) {

            // On user edits must also change alias on AROS/ACOS
            // Restrict alias ( Aro alias field must be unique ) 

            if ($this->User->save($this->request->data)) {
                $this->Flash->info(__('Saved with success.'));
                // Update aro/request access alias ('name')
                // Force login data if user is same
                if ($this->Auth->user('id') == $id) {
                    $this->Auth->login($this->request->data['User']);
                }

                $this->redirect(array('action' => 'edit_profile'));
            } else {
                $this->Flash->error(__('Could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
        if (!empty($this->Acl->Aro->validationErrors)) {
            $this->User->validationErrors['name'][] = $this->Acl->Aro->validationErrors['alias'][0];
        }
    }

    /**
     *  The AuthComponent provides the needed functionality
     *  for login, so you can leave this function blank.
     *
     * @return void
     * @access public
     */
    public function login() {
        if (isset($this->request->data['User']['language']) && $this->request->data['User']['language'] != '') {
            $this->Cookie->write('Config.language', $this->request->data['User']['language'], false, "12 months");
            Configure::write('Config.language', $this->request->data['User']['language']);
        }
        
        if ($this->request->is('post')) {

            if ($this->Auth->login()) {
                $this->rememberMe();
                return $this->redirect($this->Auth->redirectUrl()); //$this->Auth->redirectUrl()
            }
            $this->Flash->error(__('Login failed. Invalid username or password.'));
        }
        if (!isset($this->request->data['User']['language'])) {
            $this->request->data['User']['language'] = $this->Cookie->check('Config.language') ? $this->Cookie->read('Config.language') : Configure::read('Config.language');
        }
        
    }

    /**
     *  The AuthComponent provides the needed functionality
     *  for logout, so you can leave this function blank.
     *
     * @return void
     * @access public
     */
    public function logout() {
        $this->Cookie->delete('rememberMe');
        return $this->redirect($this->Auth->logout());
    }

    public function rememberMe() {
        if (isset($this->request->data['User']['rememberMe']) && $this->request->data['User']['rememberMe']) {
            // After what time frame should the cookie expire
            $cookieTime = "12 months"; // You can do e.g: 1 week, 17 weeks, 14 days
            // remove "remember me checkbox"
            unset($this->request->data['User']['rememberMe']);

            // hash the user's password
            $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);

            // write the cookie
            $this->Cookie->write('rememberMe', $this->request->data['User'], true, $cookieTime);
        }
    }

}

?>