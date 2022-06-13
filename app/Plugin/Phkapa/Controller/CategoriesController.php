<?php

/**
 * Categories controller
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
class CategoriesController extends PhkapaAppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Categories';

    /**
     * Admin index
     *
     * @return void
     * @access public
     */
    public function admin_index() {
        $this->Category->recursive = 0;
        $this->set('categories', $this->Paginator->paginate());
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
        $this->Category->recursive=2;
        $this->set('category', $this->Category->find('first', array('conditions'=>array('Category.id'=>$id))));
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
            $this->Category->create();
            if ($this->Category->save($this->request->data)) {
                $this->Flash->info(__d('phkapa', 'Saved with success.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__d('phkapa', 'Could not be saved. Please, try again.'));
            }
        }
        if ($related_id != null && $related_model != null) {
            $related_model = Inflector::classify($related_model);
            $this->Category->{$related_model}->recursive = -1;
            $modelData = $this->Category->{$related_model}->read(null, $related_id);
            $this->request->data[$related_model][0]['id'] = $modelData[$related_model]['id'];
        }
        $processes = $this->Category->Process->find('list');
        $causes = $this->Category->Cause->find('list');
        $this->set(compact('processes', 'causes'));
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
            if ($this->Category->save($this->request->data)) {
                $this->Flash->info(__d('phkapa', 'Saved with success.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__d('phkapa', 'Could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->Category->recursive=2;
            $this->request->data =  $this->Category->find('first', array('conditions'=>array('Category.id'=>$id)));
        }
        $processes = $this->Category->Process->find('list');
        $causes = $this->Category->Cause->find('list');
        $this->set(compact('processes', 'causes'));
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
        if ($this->Category->delete($id)) {
            $this->Flash->info(__d('phkapa', 'Deleted with success.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__d('phkapa', 'Could not be deleted.'));
        $this->redirect(array('action' => 'index'));
    }

}

?>