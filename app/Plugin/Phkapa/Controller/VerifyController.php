<?php

/**
 * Verify controller
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
class VerifyController extends PhkapaAppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Verify';
    /**
     * List of Models for this Controller
     *
     * @var array
     * @access public
     */
    public $uses = array('Phkapa.Ticket');
    
    /**
     * Filter from Process model
     *
     * @var array
     * @access public
     */
    public $processFilter = array();

    /**
     * Index
     *
     * @return void
     * @access public
     */ 
    public function index() {
        $this->Ticket->recursive = 2;
        $this->_setupModel();
        

        if (isset($this->request->named['keyword'])) {
            $keyword = $this->request->named['keyword'];
        }
        if (isset($this->request->query['keyword'])) {
            $keyword = $this->request->query['keyword'];
        }

        if (isset($keyword) && $keyword == '') {
            unset($keyword);
            //unset($this->request->named['keyword']);
            //unset($this->request->query['keyword']);
        }

        if (isset($keyword)) {
            $this->Paginator->settings['conditions'] = array
                    ("OR" => array(
                        "Ticket.id LIKE" => "%" . $keyword . "%",
                        "Ticket.product LIKE" => "%" . $keyword . "%",
                        "Ticket.description LIKE" => "%" . $keyword . "%",
                        "Ticket.review_notes LIKE" => "%" . $keyword . "%",
                        "Priority.name LIKE" => "%" . $keyword . "%",
                        "Safety.name LIKE" => "%" . $keyword . "%",
                        "Type.name LIKE" => "%" . $keyword . "%",
                        "Process.name LIKE" => "%" . $keyword . "%",
                        "Origin.name LIKE" => "%" . $keyword . "%",
                        "Category.name LIKE" => "%" . $keyword . "%",
                        "Activity.name LIKE" => "%" . $keyword . "%",
                        "Cause.name LIKE" => "%" . $keyword . "%",
                        "Customer.name LIKE" => "%" . $keyword . "%",
                        "Supplier.name LIKE" => "%" . $keyword . "%"),
                       
                    "AND" => array('Ticket.workflow_id' => '4', 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))
            );
            $this->set('keyword', $keyword);
        } else {
            $this->Paginator->settings['conditions'] = array('Ticket.workflow_id' => '4', 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')));
        }

        $this->set('tickets', $this->Paginator->paginate('Ticket'));
    }

    /**
     * view
     *
     * @param integer $id
     * @return void
     * @access public
     */ 
    public function view($id = null) {
         if (!$id) {
            $this->Flash->error(__d('phkapa','Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Ticket->recursive = 2;
        $this->_setupModel();
        $ticket = $this->Ticket->find('first', array('conditions' => array('Ticket.workflow_id' => '4', 'Ticket.id' => $id, 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))));
        if (count($ticket) == 0) {
            $this->Flash->error(__d('phkapa','Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('ticket', $ticket);
    }

    /**
     * close
     *
     * @param integer $id
     * @return void
     * @access public
     */ 
    public function close($id = null) {
         if (!$id) {
            $this->Flash->error(__d('phkapa','Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Ticket->recursive = 2;
        $this->_setupModel();
        $ticket = $this->Ticket->find('first', array('conditions' => array('Ticket.workflow_id' => '4', 'Ticket.id' => $id, 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))));
        
        if (count($ticket) == 0) {
            $this->Flash->error(__d('phkapa','Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }

        // only closes when all action types that require effectiveness has effectivenss results
        if (isset($ticket['Action']) && count($ticket['Action']) > 0) {
            foreach ($ticket['Action'] as $action):

                if ($action['ActionType']['verification'] == 1 && ($action['action_effectiveness_id'] == '1' || $action['action_effectiveness_id'] == null)) {
                    $this->Flash->error(__d('phkapa','Invalid request.'));
                    $this->redirect(array('action' => 'index'));
                }
            endforeach;
        }
        $now=$this->Ticket->timeFormatedField('modified',time());
        $nowClose=$this->Ticket->timeFormatedField('close_date',time());
        $this->Ticket->read(null, $id);
        $this->Ticket->set(array(
            'workflow_id' => 5,
            'close_date' => $nowClose,
            'close_user_id' => $this->Auth->user('id'),
            'modified_user_id' => $this->Auth->user('id')
        ));
        if ($this->Ticket->save()) {
        
            $this->_addNotification($id,__d('phkapa','Ticket # %s has been closed', $id));
            $this->Flash->info(__('Saved with success.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__d('phkapa','Could not be saved. Please, try again.'));
        $this->redirect(array('action' => 'index'));
    }

    /**
     * replan
     *
     * @param integer $id
     * @return void
     * @access public
     */ 
    public function replan($id = null) {
        if (!$id ) {
            $this->Flash->error(__d('phkapa','Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Ticket->recursive = 2;
        $this->_setupModel();
        $ticket = $this->Ticket->find('first', array('conditions' => array('Ticket.workflow_id' => '4', 'Ticket.id' => $id, 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))));
        if (count($ticket) == 0) {
            $this->Flash->error(__d('phkapa','Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        
        $now=$this->Ticket->timeFormatedField('modified',time());
        $nowClose=$this->Ticket->timeFormatedField('close_date',time());
        $this->Ticket->read(null, $id);
        $this->Ticket->set(array(
            'workflow_id' => 3,
            'close_date' => $nowClose,
            'close_user_id' => $this->Auth->user('id'),
            'modified_user_id' => $this->Auth->user('id')
        ));
        if ($this->Ticket->save()) {

        
            $this->_addNotification($id,__d('phkapa','Ticket # %s has new plan', $id));
            $this->Flash->info(__('Saved with success.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__d('phkapa','Could not be saved. Please, try again.'));
        $this->redirect(array('action' => 'index'));
    }
    /**
     * edit action
     *
     * @param integer $id
     * @param integer $ticketId
     * @return void
     * @access public
     */ 
    public function edit_action($id = null, $ticketId = null) {
        if (!$id) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        
        if (isset($this->request->data['Action']['ticket_id'])) {
            $ticketId = $this->request->data['Action']['ticket_id'];
        }
        
        if (!$ticketId) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->Ticket->recursive = 1;
        $ticket = $this->Ticket->find('first', array('conditions' => array('Ticket.workflow_id' => '4', 'Ticket.id' => $ticketId, 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))));
        if (count($ticket) == 0) {
            $this->Flash->error(__d('phkapa','Invalid request.'));
            $this->redirect(array('action' => 'view', $ticketId));
        }
        
        $this->Ticket->Action->recursive=1;
        $action = $this->Ticket->Action->find('first', array('conditions'=>array('Action.ticket_id'=>$ticketId,'Action.id'=>$id)));
        if (count($action) == 0) {
            $this->Flash->error(__d('phkapa','Invalid request.'));
            $this->redirect(array('action' => 'view', $ticketId));
        }
        
        if (!empty($this->request->data)) {
            $this->request->data['Action']['verify_user_id']=$this->Auth->user('id');
            if ($this->Ticket->Action->save($this->request->data)) {
                $this->Ticket->id = $ticketId;
                $this->Ticket->saveField('modified_user_id', $this->Auth->user('id'));
                $this->Flash->info(__('Saved with success.'));
                $this->redirect(array('action' => 'view', $this->request->data['Action']['ticket_id']));
            } else {
                $this->Flash->error(__d('phkapa','Could not be saved. Please, try again.'));
            }
        }
        
        
        if (empty($this->request->data)) {
            $this->request->data = $action;
        }
        
        $this->Ticket->Action->ActionEffectiveness->recursive = 0;
        $actionEffectivenesses = $this->Ticket->Action->ActionEffectiveness->find('list', array('conditions' => array('ActionEffectiveness.active' => '1')));
        $this->set(compact('actionEffectivenesses', 'action', 'ticket'));
    }

    /**
     * Setup Ticket bind model associations 
     * database access performance
     *
     * @return void
     * @access protected
     */
    protected function _setupModel() {
        // belongsTo 'Type','Process','Registar','Activity','Category','Supplier','Customer','Origin','Cause','Workflow','Parent'
        $this->Ticket->unbindModel(array(
            'belongsTo' => array('Workflow','Parent')
                ), false);
       
    
        // hasMany 'Action',  'Children'
        $this->Ticket->unbindModel(array(
            'hasMany' => array('Children')
                ), false);
        
        $this->Ticket->Registar->unbindModel(array(
            //'hasMany' => array('RegistredTicket','CloseTicket','ModifiedTicket'),
            'hasAndBelongsToMany' => array('Role', 'Process')
                ), false);
        $this->Ticket->CloseUser->unbindModel(array(
            //'hasMany' => array('RegistredTicket','CloseTicket','ModifiedTicket'),
            'hasAndBelongsToMany' => array('Role', 'Process')
                ), false);
        $this->Ticket->ModifiedUser->unbindModel(array(
            //'hasMany' => array('RegistredTicket','CloseTicket','ModifiedTicket'),
            'hasAndBelongsToMany' => array('Role', 'Process')
                ), false);
        
        
         $this->Ticket->Process->unbindModel(array(
            'hasAndBelongsToMany' => array('Activity', 'Category', 'User')
                ), false);
         
         $this->Ticket->Activity->unbindModel(array(
            'hasAndBelongsToMany' => array('Process')), false);
         
         $this->Ticket->Cause->unbindModel(array(
            'hasAndBelongsToMany' => array('Category')), false);
        
         $this->Ticket->Category->unbindModel(array(
            'hasAndBelongsToMany' => array('Process','Cause')), false);
        
       
    }
    
    /**
     * Set filter from models : Process , Activity , Category and Cause
     *
     * @return void
     * @access protected
     */
    protected function _setProcessOptions() {

        $processOptions['joins'] = array(
            array('table' => 'phkapa_processes_users',
                'alias' => 'ProcessesUser',
                'type' => 'inner',
                'conditions' => array(
                    'Process.id = ProcessesUser.process_id'
                )
            ),
            array('table' => 'users',
                'alias' => 'User',
                'type' => 'inner',
                'conditions' => array(
                    'ProcessesUser.user_id = User.id',
                )
            )
        );

        $processOptions['conditions'] = array(
            //'Process.active' => '1',
            //'User.active' => '1',
            'User.id' => $this->Auth->user('id')
        );

        //$this->loadModel('Phkapa.Process');
        $this->processFilter = array_flip($this->Ticket->Process->find('list', $processOptions));
    }
    
    /**
     * beforeFilter callback
     *
     * @param  
     * @return void
     * @access public
     * @throws 
     */ 
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Ticket->recursive = 0;
        $this->_setProcessOptions();
    }

}

?>
