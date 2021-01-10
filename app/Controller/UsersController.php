<?php

/**
 * Users controller
 *
 * PHP version 5
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
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if ($this->data['User']['language'] != '') {
                    $this->Session->write('User.language', $this->data['User']['language']);
                }
                return $this->redirect($this->Auth->redirect());
            } else {
                $this->Flash->error(__('Login failed. Invalid username or password.'));
            }
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
        $this->Session->delete('User.language');
        $this->redirect($this->Auth->logout());
    }

   

}

?>