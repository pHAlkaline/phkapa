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
class AccessUsersController extends AccessAppController {

    /**
     * Models
     *
     * @var array
     * @access public
     */
    public $uses = array('User');

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'AccessUsers';

    /**
     * Components
     *
     * @var array
     * @access public
     */
    public $components = array('Acl');

    /**
     * Admin index
     *
     * @return void
     * @access public
     */
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->Paginator->paginate('User'));
    }

    /**
     * Admin view
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function view($id = null) {
        if (!$id) {
            $this->Flash->error(__('Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    /**
     * Admin add
     *
     * @return void
     * @access public
     */
    public function add() {
        if (!empty($this->request->data)) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->info(__('Saved with success.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * Admin edit
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function edit($id = null) {
        if ($id == null) {
            $this->Flash->error(__('Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        if (!$id && empty($this->request->data)) {
            $this->Flash->error(__('Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }

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

                $this->redirect(array('action' => 'index'));
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
     * Admin delete
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function delete($id = null) {
        if ($id == null || $id == 1) {
            $this->Flash->error(__('Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->User->delete($id)) {
            $this->Flash->info(__('Deleted with success.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('Could not be deleted.'));
        $this->redirect(array('action' => 'index'));
    }

    
    /**
     * secure_password
     *
     * @param integer $id
     * @return void
     * @access private
     */
    private function secure_password() {

        $this->User->read(null, 1);

        if (empty($this->request->data)) {
            $this->Flash->error(__('Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }




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

                $this->redirect(array('action' => 'index'));
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

}

?>