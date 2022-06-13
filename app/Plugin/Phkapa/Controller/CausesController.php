<?php

/**
 * Causes controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  pHKapa
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.net>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */
class CausesController extends PhkapaAppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Causes';

    /**
     * Admin index
     *
     * @return void
     * @access public
     */
    public function admin_index() {
        $this->Cause->recursive = 0;
        $this->set('causes', $this->Paginator->paginate());
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
        $this->Cause->recursive=2;
        $this->set('cause', $this->Cause->find('first', array('conditions'=>array('Cause.id'=>$id))));
    }

    /**
     * Admin add
     *
     * @param integer $related_model
     * @param integer $related_id
     * @return void
     * @access public
     */
    public function admin_add($related_model = null, $related_id = null) {
        if (!empty($this->request->data)) {
            $this->Cause->create();
            if ($this->Cause->save($this->request->data)) {
                $this->Flash->info(__d('phkapa', 'Saved with success.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__d('phkapa', 'Could not be saved. Please, try again.'));
            }
        }
        if ($related_id != null && $related_model != null) {
            $related_model = Inflector::classify($related_model);
            $this->Cause->{$related_model}->recursive = -1;
            $modelData = $this->Cause->{$related_model}->read(null, $related_id);
            $this->request->data[$related_model][0]['id'] = $modelData[$related_model]['id'];
        }
        $categories = $this->Cause->Category->find('list');
        $this->set(compact('categories'));
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
            if ($this->Cause->save($this->request->data)) {
                $this->Flash->info(__d('phkapa', 'Saved with success.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__d('phkapa', 'Could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->Cause->recursive=2;
            $this->request->data = $this->Cause->find('first', array('conditions'=>array('Cause.id'=>$id)));
        }
        $categories = $this->Cause->Category->find('list');
        $this->set(compact('categories'));
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
        if ($this->Cause->delete($id)) {
            $this->Flash->info(__d('phkapa', 'Deleted with success.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__d('phkapa', 'Could not be deleted.'));
        $this->redirect(array('action' => 'index'));
    }

}

?>