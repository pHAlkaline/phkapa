<?php
/**
 * Actions controller
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
class ActionsController extends PhkapaAppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Actions';

    /**
     * Admin index
     *
     * @return void
     * @access public
     */ 
    public function admin_index() {
        if (isset($this->request->named['keyword'])) {
            $keyword = $this->request->named['keyword'];
        }
        if (isset($this->request->query['keyword'])) {
            $keyword = $this->request->query['keyword'];
        }

        if (isset($keyword) && $keyword == '') {
            unset($keyword);
            unset($this->request->named['keyword']);
            unset($this->request->query['keyword']);
        }

        if (isset($keyword)) {
            $this->paginate = array('conditions' => array
                    ("OR" => array(
                        "Action.id LIKE" => "%" . $keyword . "%",
                        "Action.ticket_id LIKE" => "%" . $keyword . "%",
                        "ActionType.name LIKE" => "%" . $keyword . "%",
                        "Action.description LIKE" => "%" . $keyword . "%",
                        "Action.deadline LIKE" => "%" . $keyword . "%",
                        "ActionEffectiveness.name LIKE" => "%" . $keyword . "%",
                        "Action.ticket_id LIKE" => "%" . $keyword . "%"),
                        
                )
            );
            $this->set('keyword', $keyword);
        }
        $this->Action->recursive = 0;
        $this->set('actions', $this->paginate());
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
            $this->Session->setFlash(__d('phkapa','Invalid request.'), 'flash_message_error');
            $this->redirect(array('action' => 'index'));
        }
        $this->set('action', $this->Action->read(null, $id));
        
        if (in_array($this->Action->name,Configure::read('Revision.tables'))){
           $this->set('action_revisions', $this->Action->revisions()); 
        }
    }
    
    
    /**
     * Admin view revision
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function admin_view_revision($id = null, $actionId =null) {
        if (!$id || !$actionId || !in_array($this->Action->name,Configure::read('Revision.tables'))) {
            $this->Session->setFlash(__d('phkapa', 'Invalid request.'), 'flash_message_error');
            $this->redirect(array('action' => 'view',$actionId));
        }
        
        $this->Action->id=$actionId;
        $revision=$this->Action->revisions(array('conditions'=>array('version_id'=>$id)));
        $this->set('action',$revision[0] );
        
        
    }

     /**
     * Admin add
     *
     * @param integer $ticket_id
     * @return void
     * @access public
     */ 
    public function admin_add($ticket_id = null) {
        if (!empty($this->request->data)) {
            if ($this->request->data['Action']['closed']==0) {
                unset($this->request->data['Action']['close_date']);
            }
            $this->Action->create();
            if ($this->Action->save($this->request->data)) {
                $this->Session->setFlash(__d('phkapa','Saved with success.'), 'flash_message_info');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d('phkapa','Could not be saved. Please, try again.'), 'flash_message_error');
            }
        }
        if ($ticket_id != null)
            $this->request->data['Action']['ticket_id'] = $ticket_id;
        $tickets = $this->Action->Ticket->find('list',array('order'=>array('Ticket.id'),'recursive'=>0));
        $actionTypes = $this->Action->ActionType->find('list');
        $actionEffectivenesses = $this->Action->ActionEffectiveness->find('list');
        $this->set(compact('tickets', 'actionTypes', 'actionEffectivenesses'));
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
            $this->Session->setFlash(__d('phkapa','Invalid request.'), 'flash_message_error');
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Action->save($this->request->data)) {
                $this->Session->setFlash(__d('phkapa','Saved with success.'), 'flash_message_info');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d('phkapa','Could not be saved. Please, try again.'), 'flash_message_error');
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Action->read(null, $id);
        }
        $tickets = $this->Action->Ticket->find('list',array('order'=>array('Ticket.id'),'recursive'=>0));
        $actionTypes = $this->Action->ActionType->find('list');
        $verifyUsers = $this->Action->VerifyUser->find('list');
        $closeUsers = $this->Action->CloseUser->find('list');
        $actionEffectivenesses = $this->Action->ActionEffectiveness->find('list');
        $this->set(compact('tickets', 'actionTypes', 'actionEffectivenesses', 'verifyUsers', 'closeUsers'));
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
            $this->Session->setFlash(__d('phkapa','Invalid request.'), 'flash_message_error');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Action->delete($id)) {
            $this->Session->setFlash(__d('phkapa','Deleted with success.'), 'flash_message_info');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__d('phkapa','Could not be deleted.'), 'flash_message_error');
        $this->redirect(array('action' => 'index'));
    }

}

?>