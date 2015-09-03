<?php

/**
 * Query controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  pHKapa
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */
class QueryController extends PhkapaAppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Query';

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
     * Index
     *
     * @return void
     * @access public
     */
    public function index() {
        $this->Ticket->recursive = 0;
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
            $this->Paginator->settings['conditions']= array
                    ("OR" => array(
                        "Ticket.id LIKE" => "%" . $keyword . "%",
                        "Priority.name LIKE" => "%" . $keyword . "%",
                        "Safety.name LIKE" => "%" . $keyword . "%",
                        "Type.name LIKE" => "%" . $keyword . "%",
                        "Process.name LIKE" => "%" . $keyword . "%",
                        "Origin.name LIKE" => "%" . $keyword . "%",
                        "Category.name LIKE" => "%" . $keyword . "%",
                        "Activity.name LIKE" => "%" . $keyword . "%",
                        "Cause.name LIKE" => "%" . $keyword . "%",
                        "Supplier.name LIKE" => "%" . $keyword . "%",
                        "Workflow.name LIKE" => "%" . $keyword . "%"),
                    "AND" => array('OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id'))));
            $this->set('keyword', $keyword);
        } else {
            $this->Paginator->settings['conditions'] = array('OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')));
        }
        $this->Paginator->settings['order']=array('Ticket.origin_date'=>'DESC');
        $this->Ticket->unbindModel(array(
            'hasMany' => array('Children')
                ), false);

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
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Ticket->recursive = 2;
        $this->_setupModel();
        $ticket = $this->Ticket->find('first', array('order' => '', 'conditions' => array('AND' => array('Ticket.id' => $id, 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id'))))));
        if (count($ticket) == 0) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('ticket', $ticket);
    }

    /**
     * view_action
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function view_action($id = null) {
        if (!$id) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Ticket->Action->recursive=1;
        $action=$this->Ticket->Action->find('first', array('conditions'=>array('Action.id'=>$id)));
        if (count($action) == 0) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $ticket = $this->Ticket->find('first', array('order' => '', 'conditions' => array('Ticket.id' => $action['Action']['ticket_id'], 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))));
        if (count($ticket) == 0) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('action', $action);
    }

    /**
     * print_report method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function print_report($id) {
       if (!$id) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Ticket->recursive = 2;
        $this->_setupModel();
        $ticket = $this->Ticket->find('first', array('order' => '', 'conditions' => array('Ticket.id' => $id, 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))));
        if (count($ticket) == 0) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        App::uses('CakeEvent', 'Event');
        App::uses('CakeEventManager', 'Event');
        $event = new CakeEvent('Phkapa.Ticket.PrintReport', $this, array(
            'id' => $id,
            'data' => $ticket,
        ));
        $this->getEventManager()->dispatch($event);
        
        
    }

    /**
     * export method
     * Export filtered by date range
     *
     * @return void
     * @access public
     */
    public function export() {
        
    }

    /**
     * export_csv method
     * Export CSV file with ticket records filtered by date range
     *
     * @return void
     * @access public
     */
    public function export_csv() {
        $this->_setupModel();
        $this->Ticket->recursive = 2;
        $this->Ticket->unbindModel(array(
            'hasMany' => array('Children')
                ), false);

        $range['start'] = $this->request->data['Ticket']['startdate'];
        $range['end'] = $this->request->data['Ticket']['enddate'];
        $data = $this->Ticket->find('all', array('order' => 'Ticket.created', 'conditions' => array('Ticket.origin_date BETWEEN ? AND ?' => array($range['start']['year'] . '-' . $range['start']['month'] . '-' . $range['start']['day'], $range['end']['year'] . '-' . $range['end']['month'] . '-' . $range['end']['day']), 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))));
        if ($this->request->data['Ticket']['data_to_export'] == 'a') {
            $this->export_csv_actions(Set::extract('/Ticket/id',$data));
            return;
        }
        $excludePaths = array(
            'Ticket.cause_id', 'Cause.id',
            'Ticket.type_id', 'Type.id',
            'Ticket.process_id', 'Process.id',
            'Ticket.priority_id', 'Priority.id',
            'Ticket.safety_id', 'Safety.id',
            'Ticket.registar_id', 'Registar.id',
            'Ticket.activity_id', 'Activity.id',
            'Ticket.category_id', 'Category.id',
            'Ticket.origin_id', 'Origin.id',
            'Ticket.supplier_id', 'Supplier.id',
            'Ticket.workflow_id', 'Workflow.id',
            'Ticket.modified_user_id', 'ModifiedUser.id',
            'Ticket.close_user_id', 'CloseUser.id',
        );
        
        App::uses('CakeEvent', 'Event');
        App::uses('CakeEventManager', 'Event');
        $event = new CakeEvent('Phkapa.Ticket.Export', $this, array(
            'data' => $data,
            'excludePaths' => $excludePaths,
            'fileName'=>'phkapa_tickets_export.csv'
        ));
        $this->getEventManager()->dispatch($event);
    }

    /**
     * export_csv_acions method
     * Export CSV file with actions records filtered by tickets on date range
     *
     * @return void
     * @access public
     */
    public function export_csv_actions($tickets) {
        $this->Ticket->Action->recursive = 2;
        $data = $this->Ticket->Action->find('all', array('conditions' => array('ticket_id'=>$tickets)));

         $excludePaths = array(
            'Action.action_type_id', 'ActionType.id',
            'Action.action_effectiveness_id', 'ActionEffectiveness.id',
            'Action.verify_user_id', 'VerifyUser.id',
            'Action.close_user_id', 'CloseUser.id',
            'Action.modified_user_id', 'ModifiedUser.id',
        );
        
        App::uses('CakeEvent', 'Event');
        App::uses('CakeEventManager', 'Event');
        $event = new CakeEvent('Phkapa.TicketAction.Export', $this, array(
            'data' => $data,
            'excludePaths' => $excludePaths,
            'fileName' => 'phkapa_tickets_actions_export.csv'
        ));
        $this->getEventManager()->dispatch($event);
    }

    /**
     * Set filter from models : Process to apply on Tickets with user has process relation
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
     * Setup Ticket bind model associations 
     * database access performance
     *
     * @return void
     * @access protected
     */
    protected function _setupModel() {
// belongsTo 'Type','Process','Registar','Activity','Category','Supplier','Origin','Cause','Workflow','Parent'
        $this->Ticket->unbindModel(array(
            'belongsTo' => array('Parent')
                ), false);
// hasMany 'Action',  'Children'
        $this->Ticket->unbindModel(array(
            'hasMany' => array()
                ), false);

        $this->Ticket->Registar->unbindModel(array(
            'hasAndBelongsToMany' => array('Process')), false);

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
        $this->_setupModel();
        $this->_setProcessOptions();
    }

}

?>
