<?php
/**
 * Users controller
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
class UsersController extends PhkapaAppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Users';
     
     /**
     * Admin index
     *
     * @return void
     * @access public
     */
     public function admin_index() {
        $allowedUsers=$this->_allowedUsers();
        $this->set(compact('allowedUsers'));
        $this->User->recursive = 0;
        $this->Paginator->settings['conditions'] = array ('User.id' => $allowedUsers);
        $this->set('users', $this->Paginator->paginate());
    }

    /**
     * Admin view
     *
     * @param integer $id
     * @return void
     * @access public
     */ 
    public function admin_view($id = null) {
        if (!$id) {
            $this->Flash->error(__d('phkapa','Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        if (!in_array($id, $this->_allowedUsers())){
            $this->Flash->error(__d('phkapa','Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->User->recursive=1;
        $this->set('user', $this->User->find('first', array('conditions'=>array('User.id'=>$id))));
    }

    /**
     * Admin add
     *
     * @return void
     * @access public
     */ 
    public function admin_add() {
        $this->Flash->error(__d('phkapa','Invalid request.'));
        $this->redirect(array('action' => 'index'));
       
    }

    /**
     * Admin edit
     *
     * @param integer $id
     * @return void
     * @access public
     */ 
    public function admin_edit($id = null) {
        
        if (!$id && empty($this->request->data)) {
            $this->Flash->error(__d('phkapa','Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        if (!in_array($id, $this->_allowedUsers())){
            $this->Flash->error(__d('phkapa','Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->info(__('Saved with success.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__d('phkapa','Could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->User->recursive=1;
            $this->request->data = $this->User->find('first', array('conditions'=>array('User.id'=>$id)));
            if (empty($this->request->data)) {
                $this->Flash->error(__d('phkapa','Invalid request.'));
                $this->redirect(array('action' => 'index'));
            }
        }
        $processes = $this->User->Process->find('list');
        $this->set(compact('processes'));
    }

    /**
     * List of allowed users with access to phkapa plugin
     *
     * @return array $allowedUsers
     * @access protected
     */ 
    protected function _allowedUsers() {
        $allowedUsers=array();
        $recursiveValue=$this->User->recursive;
        $this->User->recursive = 0;
        $users = $this->User->find('all', array('fields' => array('id', 'name')));
        $this->User->recursive = $recursiveValue;
        foreach ($users as $user):
            if ($this->checkAccess('phkapa',$user['User']['name'])){
                $allowedUsers[]=$user['User']['id'];
            }
            
        endforeach;
        return $allowedUsers;
        
    }

}

?>