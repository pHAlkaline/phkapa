<?php
/**
 * Users controller
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
class PhkapaUsersController extends PhkapaAppController {

    /**
     * List of Models for this Controller
     *
     * @var array
     * @access public
     */
    public $uses = array('User','Phkapa.PhkapaUser');
    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'PhkapaUsers';
     
     /**
     * Admin index
     *
     * @return void
     * @access public
     */
     public function admin_index() {
        $allowedUsers=$this->_allowedUsers();
        $this->set(compact('allowedUsers'));
        $this->PhkapaUser->recursive = 0;
        $this->Paginator->settings['conditions'] = array ('PhkapaUser.id' => $allowedUsers);
        $this->set('users', $this->Paginator->paginate('PhkapaUser'));
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
        $this->PhkapaUser->recursive=1;
        $this->set('user', $this->PhkapaUser->find('first', array('conditions'=>array('PhkapaUser.id'=>$id))));
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
            if ($this->PhkapaUser->save($this->request->data)) {
                $this->Flash->info(__('Saved with success.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__d('phkapa','Could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->PhkapaUser->recursive=1;
            $this->request->data = $this->PhkapaUser->find('first', array('conditions'=>array('PhkapaUser.id'=>$id)));
            if (empty($this->request->data)) {
                $this->Flash->error(__d('phkapa','Invalid request.'));
                $this->redirect(array('action' => 'index'));
            }
        }
        $processes = $this->PhkapaUser->Process->find('list');
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