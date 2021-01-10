<?php

/**
 * Acos controller
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
class AcosController extends AccessAppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Acos';

    /**
     * List of Models for this Controller
     *
     * @var array
     * @access public
     */
    public $uses = array('Access.Aco');

    /**
     * List of Components for this Controller
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
        $nodelist = $this->Node->generateTreeList(null, '{n}.Aco.id', '{n}.Aco.alias', ' - ', '-1');
        $this->set(compact('nodelist'));
    }

    /**
     * Admin add
     *
     * @return void
     * @access public
     */
    public function add() {

        if (!empty($this->request->data)) {
            if ($this->Node->save($this->request->data)) {
                $this->Flash->info(__('Saved with success.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Could not be saved. Please, try again.'));
            }
        }
        $parents[0] = "[ No Parent ]";
        $nodelist = $this->Node->generateTreeList(null, '{n}.Aco.id', '{n}.Aco.alias', ' - ', '-1');
        if ($nodelist) {
            foreach ($nodelist as $key => $value):
                $parents[$key] = $value;
            endforeach;
        }

        $this->set(compact('parents'));
    }

    /**
     * Admin edit
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function edit($id = null) {
        if ($id == null || $id < 3) {
            $this->Flash->error(__('Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }

        if (!empty($this->request->data)) {
            if ($this->Node->save($this->request->data)) {
                $this->Flash->info(__('Saved with success.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Node->read(null, $id);
        }
        $parents[0] = "[ No Parent ]";
        $nodelist = $this->Node->generateTreeList(null, '{n}.Aco.id', '{n}.Aco.alias', ' - ', '-1');
        if ($nodelist) {
            foreach ($nodelist as $key => $value):
                $parents[$key] = $value;
            endforeach;
        }

        $this->set(compact('parents'));
    }

    /**
     * Admin delete
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function delete($id = null) {
        if ($id == null || $id < 3) {
            $this->Flash->error(__('Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Node->id = $id;
        if ($this->Node->delete()) {
            $this->Flash->info(__('Saved with success.'));
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Flash->error(__('Could not be saved. Please, try again.'));
        }
    }

    /**
     * Admin move up
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function moveup($id = null) {
        if ($id == null || $id < 3) {
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
    }

    /**
     * Admin move down
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function movedown($id = null) {
        if ($id == null || $id < 3) {
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
        $this->Node = & $this->Acl->Aco;
    }

}

?>
