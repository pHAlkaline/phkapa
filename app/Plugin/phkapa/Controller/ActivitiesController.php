<?php

/**
 * Activities controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  PHKAPA
 * @version  RC1
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.phalkaline.eu
 */
class ActivitiesController extends PhkapaAppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Activities';

    /**
     * Admin index
     *
     * @return void
     * @access public
     */
    public function admin_index() {
        $this->Activity->recursive = 0;
        $this->set('activities', $this->paginate());
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
            $this->Session->setFlash(__d('phkapa', 'Invalid request.'), 'flash_message_error');
            $this->redirect(array('action' => 'index'));
        }
        $this->set('activity', $this->Activity->read(null, $id));
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
            $this->Activity->create();
            if ($this->Activity->save($this->request->data)) {
                $this->Session->setFlash(__d('phkapa', 'Saved with success.'), 'flash_message_info');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d('phkapa', 'Could not be saved. Please, try again.'), 'flash_message_error');
            }
        }

        if ($related_id != null && $related_model != null) {
            $related_model = Inflector::classify($related_model);

            $this->Activity->{$related_model}->recursive = -1;
            $modelData = $this->Activity->{$related_model}->read(null, $related_id);
            $this->request->data[$related_model][0]['id'] = $modelData[$related_model]['id'];
        }
        $processes = $this->Activity->Process->find('list');
        $this->set(compact('processes'));
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
            $this->Session->setFlash(__d('phkapa', 'Invalid request.'), 'flash_message_error');
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Activity->save($this->request->data)) {
                $this->Session->setFlash(__d('phkapa', 'Saved with success.'), 'flash_message_info');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d('phkapa', 'Could not be saved. Please, try again.'), 'flash_message_error');
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Activity->read(null, $id);
        }
        $processes = $this->Activity->Process->find('list');
        $this->set(compact('processes'));
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
            $this->Session->setFlash(__d('phkapa', 'Invalid request.'), 'flash_message_error');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Activity->delete($id)) {
            $this->Session->setFlash(__d('phkapa', 'Deleted with success.'), 'flash_message_info');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__d('phkapa', 'Could not be deleted.'), 'flash_message_error');
        $this->redirect(array('action' => 'index'));
    }

}

?>