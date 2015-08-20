<?php
/**
 * Aros controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  PHKAPA
 * @version  V1.4
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */
class ArosController extends AccessAppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Aros';

    /**
     * Models
     *
     * @var array
     * @access public
     */
    public $uses = array('Access.User');

    /**
     * Components
     *
     * @var array
     * @access public
     */
    public $components = array('Acl');

    /**
     * Object instance of component Acl->Aco 
     *
     * @var object
     * @access public
     */
    public $Node = null;

    /**
     * Admin index
     *
     * @return void
     * @access public
     */
    public function index() {
        $nodelist = $this->Node->generateTreeList(null, '{n}.Aro.id', '{n}.Aro.alias', ' - ', '-1');
        $groupNodeList = $this->Node->find('all', array('recursive' => 0, 'conditions' => array('foreign_key' => null)));
        $groupNodeList = Set::extract('/Aro/id', $groupNodeList);
        $this->set(compact('nodelist', 'groupNodeList'));
    }

    /**
     * Admin add
     *
     * @return void
     * @access public
     */
    public function add() {

        if (!empty($this->request->data)) {

            // update alias with user data
            if ($this->request->data['Aro']['foreign_key'] != '') {
                $this->request->data['Aro']['model'] = 'User';
                $this->request->data['Aro']['alias'] = $this->User->field('Name', array('id' => $this->request->data['Aro']['foreign_key']));
            }

            // alias must be unique
            $this->Node->validate = array(
                'alias' => array(
                    'rule' => 'isUnique',
                    'message' => __('Group / User name must be unique!!')
                    ));

            if ($this->Node->save($this->request->data)) {
                $this->Flash->info(__('Saved with success.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Could not be saved. Please, try again.'));
            }
        }
        $parents[0] = "[ No Parent ]";
        $nodelist = $this->Node->generateTreeList(null, '{n}.Aro.id', '{n}.Aro.alias', ' - ', '-1');
        if ($nodelist)
            foreach ($nodelist as $key => $value)
                $parents[$key] = $value;

        $usersOnAro = $this->Node->find('list', array('fields' => array('Aro.foreign_key'), 'conditions' => array('Aro.foreign_key <>' => null)));
        $foreignKeys = $this->User->find('list', array('conditions' => array('User.active' => '1', 'NOT' => array('User.id' => $usersOnAro))));
        $this->set(compact('parents', 'foreignKeys'));
    }

    /**
     * Admin edit
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function edit($id = null) {
        // Protect against administrator edit
        if ($id == null || $id < 4) {
            $this->Flash->error(__('Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }

        $errors = null;
        if (!empty($this->request->data)) {
            $this->request->data['Aro']['model'] = '';

            // update alias with user data
            if ($this->request->data['Aro']['foreign_key'] != '') {
                $this->request->data['Aro']['model'] = 'User';
                $this->request->data['Aro']['alias'] = $this->User->field('Name', array('id' => $this->request->data['Aro']['foreign_key']));
            }

            $this->Node->recursive = -1;
            $this->request->data = array_merge($this->Node->read(null, $id), $this->request->data);

            // alias must be unique
            $this->Node->validate = array(
                'alias' => array(
                    'rule' => 'isUnique',
                    'message' => __('Group / User name must be unique!!')
                    ));

            if ($this->Node->save($this->request->data)) {
                $this->Flash->info(__('Saved with success.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Could not be saved. Please, try again.'));
            }
        }

        if (empty($this->request->data)) {
            $this->request->data = $this->Node->read(null, $id);
        }
        $parents[0] = "[ " . __('Root') . " ]";
        $nodelist = $this->Node->generateTreeList(null, '{n}.Aro.id', '{n}.Aro.alias', ' - ', '-1');
        $acolist = $this->Acl->Aco->generateTreeList(null, '{n}.Aco.id', '{n}.Aco.alias', ' - ', '-1');
        $acoAccessList = $this->Acl->Aco->generateTreeList(null, '{n}.Aco.id', '{n}.Aco.alias', '', '-1');
        $acoAliasList = $acoAccessList;

        foreach ($acoAccessList as $key => $value):
            $alias = "";
            $path = $this->Acl->Aco->getPath($key);
            foreach ($path as $pathAlias) {
                if ($alias != '')
                    $alias = $alias . '/';
                $alias = $alias . $pathAlias['Aco']['alias'];
            }
            $acoAliasList[$key] = $alias;
            $acoAccessList[$key] = $this->Acl->check($this->request->data['Aro']['alias'], $alias); #value
        endforeach;

        if ($nodelist) {
            foreach ($nodelist as $key => $value):
                $parents[$key] = $value;
            endforeach;
        }

        $foreignKeys = array();

        // if node is group type ( without foreignKey ) do no show available users
        if ($this->Node->field('foreign_key')) {
            $usersOnAro = $this->Node->find('list', array('fields' => array('Aro.foreign_key'), 'conditions' => array('Aro.foreign_key <>' => null, 'Aro.id <>' => $id)));
            $foreignKeys = $this->User->find('list', array('conditions' => array('User.active' => '1', 'NOT' => array('User.id' => $usersOnAro))));
        }

        $this->set(compact('parents', 'acolist', 'foreignKeys', 'acoAccessList', 'acoAliasList'));
    }

    /**
     * Admin allow
     *
     * @param integer $id
     * @param string $aco
     * @param string $aro
     * @return void
     * @access public
     */
    public function allow($id = null, $aco = null, $aro = null) {
        if ($id == null || $id < 4) {
            $this->Flash->error(__('Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $aco = str_replace("*", "/", $aco);
        $this->Acl->allow($aro, $aco);
        $this->redirect(array('action' => 'edit', $id));
    }

    /**
     * Admin deny
     *
     * @param integer $id
     * @param string $aco
     * @param string $aro
     * @return void
     * @access public
     */
    public function deny($id = null, $aco = null, $aro = null) {
        if ($id == null || $id < 4) {
            $this->Flash->error(__('Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $aco = str_replace("*", "/", $aco);
        $this->Acl->deny($aro, $aco);
        $this->redirect(array('action' => 'edit', $id));
    }

    /**
     * Admin remove
     *
     * @param integer $id
     * @param string $aco
     * @param string $aro
     * @return void
     * @access public
     */
    public function remove($id = null, $aco = null, $aro = null) {
        if ($id == null || $id < 4) {
            $this->Flash->error(__('Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }

        $this->redirect(array('action' => 'edit', $id));
    }

    /**
     * Admin admin delete
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function delete($id = null) {
        if ($id == null || $id < 4) {
            $this->Flash->error(__('Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Node->id = $id;
        if ($this->Node->delete()) {
            $this->Flash->info(__('Deleted with success.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('Could not be deleted.'));
        $this->redirect(array('action' => 'index'));
    }

    /**
     * Admin move up
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function moveup($id = null) {
        if ($id == null || $id < 4) {
            $this->Flash->error(__('Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Node->id = $id;
        if ($this->Node->moveUp()) {
            $this->Flash->info(__('Saved with success.'));
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Flash->error(__('Could not be saved. Please, try again.'));
        }
        $this->redirect(array('action' => 'index'));
    }

    /**
     * Admin move down
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function movedown($id = null) {
        if ($id == null || $id < 4) {
            $this->Flash->error(__('Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Node->id = $id;
        if ($this->Node->moveDown()) {
            $this->Flash->info(__('Saved with success.'));
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Flash->error(__('Could not be saved. Please, try again.'));
        }
        $this->redirect(array('action' => 'index'));
    }

    /**
     * beforeFilter
     *
     * @return void
     * @access public
     * @throws 
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Node = &$this->Acl->Aro;
    }

}

?>
