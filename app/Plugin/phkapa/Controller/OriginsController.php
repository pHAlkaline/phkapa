<?php
/**
 * Origins controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  PHKAPA
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */
class OriginsController extends PhkapaAppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Origins';

    /**
     * Admin index
     *
     * @return void
     * @access public
     */
    public function admin_index() {
        $this->Origin->recursive = 0;
        $this->set('origins', $this->paginate());
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
        $this->set('origin', $this->Origin->read(null, $id));
    }

    /**
     * Admin add
     *
     * @return void
     * @access public
     */
    public function admin_add() {
        if (!empty($this->request->data)) {
            $this->Origin->create();
            if ($this->Origin->save($this->request->data)) {
                $this->Session->setFlash(__d('phkapa', 'Saved with success.'), 'flash_message_info');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d('phkapa', 'Could not be saved. Please, try again.'), 'flash_message_error');
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
            $this->Session->setFlash(__d('phkapa', 'Invalid request.'), 'flash_message_error');
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Origin->save($this->request->data)) {
                $this->Session->setFlash(__d('phkapa', 'Saved with success.'), 'flash_message_info');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d('phkapa', 'Could not be saved. Please, try again.'), 'flash_message_error');
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Origin->read(null, $id);
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
            $this->Session->setFlash(__d('phkapa', 'Invalid request.'), 'flash_message_error');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Origin->delete($id)) {
            $this->Session->setFlash(__d('phkapa', 'Deleted with success.'), 'flash_message_info');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__d('phkapa', 'Could not be deleted.'), 'flash_message_error');
        $this->redirect(array('action' => 'index'));
    }

}

?>