<?php

/**
 * Action Types controller
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
class ActionTypesController extends PhkapaAppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'ActionTypes';

    /**
     * Admin index
     *
     * @return void
     * @access public
     */
    public function admin_index() {
        $this->ActionType->recursive = 0;
        $this->set('action_types', $this->Paginator->paginate());
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
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('action_type', $this->ActionType->read(null, $id));
    }

    /**
     * Admin add
     *
     * @return void
     * @access public
     */
    public function admin_add() {
        if (!empty($this->request->data)) {
            $this->ActionType->create();
            if ($this->ActionType->save($this->request->data)) {
                $this->Flash->info(__d('phkapa', 'Saved with success.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__d('phkapa', 'Could not be saved. Please, try again.'));
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
    public function admin_edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->ActionType->save($this->request->data)) {
                $this->Flash->info(__d('phkapa', 'Saved with success.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__d('phkapa', 'Could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->ActionType->read(null, $id);
        }
    }

    /**
     * Admin delete
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function admin_delete($id = null) {
        if (!$id) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->ActionType->delete($id)) {
            $this->Flash->info(__d('phkapa', 'Deleted with success.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__d('phkapa', 'Could not be deleted.'));
        $this->redirect(array('action' => 'index'));
    }

}

?>