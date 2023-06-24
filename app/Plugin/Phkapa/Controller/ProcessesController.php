<?php

/**
 * Processes controller
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
class ProcessesController extends PhkapaAppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Processes';

    /**
     * Admin index
     *
     * @return void
     * @access public
     */
    public function admin_index() {
        $this->Process->recursive = 0;
        $this->set('processes', $this->Paginator->paginate());
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
        $this->Process->recursive=2;
        $this->set('process', $this->Process->find('first', array('conditions'=>array('Process.id'=>$id))));
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
            $this->Process->create();
            if ($this->Process->save($this->request->data)) {
                $this->Flash->info(__d('phkapa', 'Saved with success.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__d('phkapa', 'Could not be saved. Please, try again.'));
            }
        }
        if ($related_id != null && $related_model != null) {
            $related_model = Inflector::classify($related_model);
            $this->Process->{$related_model}->recursive = -1;
            $modelData = $this->Process->{$related_model}->read(null, $related_id);
            $this->request->data[$related_model][0]['id'] = $modelData[$related_model]['id'];
        }
        $activities = $this->Process->Activity->find('list');
        $categories = $this->Process->Category->find('list');
        $users = $this->Process->User->find('list');
        $this->set(compact('activities', 'categories', 'users'));
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
            if ($this->Process->save($this->request->data)) {
                $this->Flash->info(__d('phkapa', 'Saved with success.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__d('phkapa', 'Could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->Process->recursive=2;
            $this->request->data = $this->Process->find('first', array('conditions'=>array('Process.id'=>$id)));
        }

        $activities = $this->Process->Activity->find('list');
        $categories = $this->Process->Category->find('list');
        $users = $this->Process->User->find('list');
        $this->set(compact('activities', 'categories', 'users'));
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
        if ($this->Process->delete($id)) {
            $this->Flash->info(__d('phkapa', 'Deleted with success.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__d('phkapa', 'Could not be deleted.'));
        $this->redirect(array('action' => 'index'));
    }

}

?>