<?php

/**
 * Plan controller
 *
 * PHP version 7
 *
 * @category Controller
 * @package  pHKapa
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.net>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */
class PlanController extends PhkapaAppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Plan';

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
    public $processOptions = array();

    /**
     * Filter for Ticket -> Process model ( User process related )
     *
     * @var array
     * @access public
     */
    public $processFilter = array();

    /**
     * Filter from Cause model
     *
     * @var array
     * @access public
     */
    public $causeOptions = array();

    /**
     * index
     *
     * @return void
     * @access public
     */
    public function index() {

        $this->Ticket->recursive = 2;
        $this->_setupModel();

        if (isset($this->request->params['named']['keyword'])) {
            $keyword = $this->request->params['named']['keyword'];
        }
        if (isset($this->request->query['keyword'])) {
            $keyword = $this->request->query['keyword'];
        }

        if (isset($keyword) && $keyword == '') {
            unset($keyword);
            //unset($this->request->params['named']['keyword']);
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
                        "Supplier.name LIKE" => "%" . $keyword . "%",
                        "Customer.name LIKE" => "%" . $keyword . "%"),
                
                        
                "AND" => array('Ticket.workflow_id' => '3', 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))
            );
            $this->set('keyword', $keyword);
        } else {
            $this->Paginator->settings['conditions'] = array('Ticket.workflow_id' => '3', 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')));
        }

        $this->set('tickets', $this->Paginator->paginate('Ticket'));
    }

    /**
     * edit
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function edit($id = null) {
        if (!$id) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Ticket->recursive = 2;
        $this->_setupModel();
        $ticket = $this->Ticket->find('first', array(
            'order' => '',
            'conditions' => array(
                'Ticket.workflow_id' => '3', 'Ticket.id' => $id,
                    'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))
        ));
        if (count($ticket) == 0) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            $this->request->data['Ticket']['workflow_id'] = 3;
            if ($this->Ticket->save($this->request->data)) {
                $this->Flash->info(__d('phkapa', 'Saved with success.'));
                $this->redirect(array('action' => 'edit', $id));
            } else {
                $this->Flash->error(__d('phkapa', 'Could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $ticket; //$this->Ticket->read(null, $id);
        }

        $this->_setCauseOptions();
        $causes = $this->Ticket->Cause->find('list', $this->causeOptions);
        $this->set(compact('ticket', 'causes'));
    }

    /**
     * add action
     *
     * @param integer $ticketId
     * @return void
     * @access public
     */
    public function add_action($ticketId = null) {
        if (!$ticketId) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->_setupModel();
        if (isset($this->request->data['Action']['ticket_id'])) {
            $ticketId = $this->request->data['Action']['ticket_id'];
        }
        $this->Ticket->recursive = 1;
        $ticket = $this->Ticket->find('first', array(
            'conditions' => array(
                'Ticket.workflow_id' => '3',
                    'Ticket.id' => $ticketId,
                    'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))
        ));
        if (count($ticket) == 0) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            $this->Ticket->Action->create();
            if ($this->request->data['Action']['closed'] == 1) {
                $this->request->data['Action']['close_date'] = $this->Ticket->Action->timeFormatedField('close_date', time());
                $this->request->data['Action']['close_user_id'] = AuthComponent::user('id');
            }
            if ($this->Ticket->Action->save($this->request->data)) {
                $this->Ticket->id = $ticketId;
                $this->Ticket->saveField('modified_user_id', $this->Auth->user('id'));
                $this->Flash->info(__d('phkapa', 'Saved with success.'));
                $this->redirect(array('action' => 'edit', $this->request->data['Action']['ticket_id'],'#'=>'tabs-actions'));
            } else {
                $this->Flash->error(__d('phkapa', 'Could not be saved. Please, try again.'));
            }
        }
        $actionTypes = $this->Ticket->Action->ActionType->find('list', array('conditions' => array('ActionType.active' => '1')));
        if (count($actionTypes) == 0) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }

        $this->set(compact('actionTypes', 'ticket'));
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

        $this->_setupModel();
        $this->Ticket->recursive = 1;
        $ticket = $this->Ticket->find('first', array(
            'conditions' => array(
                'Ticket.workflow_id' => '3',
                    'Ticket.id' => $ticketId,
                    'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))
        ));

        if (count($ticket) == 0) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'edit', $this->request->data['Action']['ticket_id'],'#'=>'tabs-actions'));
        }
        //$this->loadModel('Phkapa.Action');
        if (!empty($this->request->data)) {

            if (!$this->request->data['Action']['closed'] == '1') {
                $this->request->data['Action']['close_date'] = null;
            }
            if ($this->request->data['Action']['was_closed'] == '' && $this->request->data['Action']['closed'] == '1') {
                $this->request->data['Action']['close_date'] = $this->Ticket->Action->timeFormatedField('close_date', time());
                $this->request->data['Action']['close_user_id'] = AuthComponent::user('id');
            }

            $this->Ticket->Action->validator()->remove('close_date');
            if ($this->Ticket->Action->save($this->request->data)) {
                $this->Ticket->id = $ticketId;
                $this->Ticket->saveField('modified_user_id', $this->Auth->user('id'));
                $this->Flash->info(__d('phkapa', 'Saved with success.'));
                $this->redirect(array('action' => 'edit', $this->request->data['Action']['ticket_id'],'#'=>'tabs-actions'));
            } else {
                $this->Flash->error(__d('phkapa', 'Could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Ticket->Action->read(null, $id);
        }
        $actionTypes = $this->Ticket->Action->ActionType->find('list', array('conditions' => array('ActionType.active' => '1')));
        if (count($actionTypes) == 0) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set(compact('actionTypes', 'ticket'));
    }

    /**
     * delete action
     *
     * @param integer $id
     * @param integer $ticketId
     * @return void
     * @access public
     */
    public function delete_action($id = null, $ticketId = null) {
        if (!$id || !$ticketId) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->Ticket->recursive = 0;
        $countTicket = $this->Ticket->find('count', array(
            'conditions' => array(
                'Ticket.workflow_id' => '3', 'Ticket.id' => $ticketId,
                    'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))
        ));
        if ($countTicket == 0) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'edit', $ticketId,'#'=>'tabs-actions'));
        }
        //$this->loadModel('Phkapa.Action');
        if ($this->Ticket->Action->delete($id)) {
            $this->Ticket->id = $ticketId;
            $this->Ticket->saveField('modified_user_id', $this->Auth->user('id'));
            $this->Flash->info(__d('phkapa', 'Deleted with success.'));
             $this->redirect(array('action' => 'edit', $ticketId,'#'=>'tabs-actions'));
        }
        $this->Flash->error(__d('phkapa', 'Could not be deleted.'));
        $this->redirect(array('action' => 'edit', $ticketId));
    }

    /**
     * close action
     *
     * @param integer $id
     * @param integer $ticketId
     * @return void
     * @access public
     */
    public function close_action($id = null, $ticketId = null) {
        if (!$id || !$ticketId) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->Ticket->recursive = 0;
        $countTicket = $this->Ticket->find('count', array(
            'conditions' => array(
                'AND' => array(
                    'Ticket.workflow_id' => '3', 'Ticket.id' => $ticketId,
                    'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id'))))
        ));
        if ($countTicket == 0) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
             $this->redirect(array('action' => 'edit', $ticketId,'#'=>'tabs-actions'));
        }
        //$this->loadModel('Phkapa.Action');
        $nowClose = $this->Ticket->Action->timeFormatedField('close_date', time());
        $now = $this->Ticket->Action->timeFormatedField('modified', time());
        $this->Ticket->Action->read(null, $id);
        $this->Ticket->Action->set(array(
            'closed' => 1,
            'close_date' => $nowClose,
            'close_user_id' => $this->Auth->user('id'),
            'modified_user_id' => $this->Auth->user('id')
        ));
        if ($this->Ticket->Action->save()) {
            $this->Ticket->id = $ticketId;
            $this->Ticket->saveField('modified_user_id', $this->Auth->user('id'));
            $this->Flash->info(__d('phkapa', 'Closed with success.'));
             $this->redirect(array('action' => 'edit', $ticketId,'#'=>'tabs-actions'));
        }
        $this->Flash->error(__d('phkapa', 'Could not be closed.'));
        $this->redirect(array('action' => 'edit', $ticketId));
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
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->send($id);
    }

    /**
     * send
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function send($id = null) {
        if (!$id) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Ticket->recursive = -1;
        $this->Ticket->order = null;
        $ticket = $this->Ticket->find('first', array(
            'order' => '',
            'conditions' => array(
                'Ticket.id' => $id,
                    'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))
        ));

        if (count($ticket) == 0) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }

        if ($ticket['Ticket']['cause_id'] == null) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Ticket->Action->recursive = 1;
        $actions = $this->Ticket->Action->find('all', array('conditions' => array('Action.ticket_id' => $id)));

        $workflowId = 5;
        $now = $this->Ticket->timeFormatedField('modified', time());
        $nowClose = $this->Ticket->timeFormatedField('close_date', time());
        foreach ($actions as $action) {

            if ($action['Action']['closed'] == 0) {
                $this->Flash->error(__d('phkapa', 'Invalid request.'));
                $this->redirect(array('action' => 'index'));
            }
            if ($action['ActionType']['verification'] != 0) {
                $workflowId = 4;
                $nowClose = null;
            }
        }

        $this->Ticket->read(null, $id);
        $this->Ticket->set(array(
            'workflow_id' => $workflowId,
            'close_date' => $nowClose,
            'close_user_id' => $this->Auth->user('id'),
            'modified_user_id' => $this->Auth->user('id')
        ));
        if ($this->Ticket->save()) {
            if ($nowClose != null) {

                $this->_addNotification($id, __d('phkapa', 'Ticket # %s has been closed', $id));
            }
            $this->Flash->info(__d('phkapa', 'Saved with success.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__d('phkapa', 'Could not be saved. Please, try again.'));
        $this->redirect(array('action' => 'index'));
    }

    /**
     * Set filter from models : Process to apply on Tickets with only user has process relation
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
     * Set filter from models : Cause to apply on Tickets
     *
     * @return void
     * @access protected
     */
    protected function _setCauseOptions() {

        $category_id = -1;
        if (isset($this->request->data['Ticket']['category_id']) && $this->request->data['Ticket']['category_id'] != '') {
            $category_id = $this->request->data['Ticket']['category_id'];
        }
        $this->causeOptions['joins'] = array(
            array('table' => 'phkapa_categories_causes',
                'alias' => 'CategoriesCauses',
                'type' => 'inner',
                'conditions' => array(
                    'Cause.id = CategoriesCauses.cause_id'
                )
            ),
            array('table' => 'phkapa_categories',
                'alias' => 'Category',
                'type' => 'inner',
                'conditions' => array(
                    'CategoriesCauses.category_id = Category.id ',
                )
            )
        );

        $this->causeOptions['conditions'] = array(
            'Cause.active' => '1',
            'Category.active' => '1',
            'Category.id' => $category_id
        );
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
            'belongsTo' => array('Workflow', 'Parent')
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
            'hasAndBelongsToMany' => array('Process', 'Cause')), false);
    }

    /**
     * beforeFilter callback
     *
     * @param  
     * @return 
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
