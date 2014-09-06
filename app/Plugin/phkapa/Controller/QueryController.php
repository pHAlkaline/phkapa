<?php

/**
 * Query controller
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
class QueryController extends PhkapaAppController {
    
    /**
     * Components
     *
     * @var array
     */
    public $components = array('RequestHandler');


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
            $this->paginate = array('conditions' => array
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
                    "AND" => array('OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))));
            $this->set('keyword', $keyword);
        } else {
            $this->paginate = array('conditions' => array('OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id'))));
        }
        $this->Ticket->unbindModel(array(
            'hasMany' => array('Children')
                ), false);

        $this->set('tickets', $this->paginate());
    }

    /**
     * view
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function view($id = null) {
        $this->Ticket->recursive = 2;
        $this->_setupModel();
        $ticket = $this->Ticket->find('first', array('order'=>'', 'conditions' => array('AND' => array('Ticket.id' => $id, 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id'))))));
        if (!$id || count($ticket) == 0) {
            $this->Session->setFlash(__d('phkapa', 'Invalid request.'), 'flash_message_error');
            //$this->redirect(array('action' => 'index'));
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
            $this->Session->setFlash(__d('phkapa','Invalid request.'), 'flash_message_error');
            $this->redirect(array('action' => 'index'));
        }
        $this->set('action', $this->Ticket->Action->read(null, $id));
        
    }
    
    /**
     * pdf method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function pdf($id) {
        // increase memory limit in PHP 
        ini_set('memory_limit', '256M');
        $this->Ticket->recursive = 2;
        $this->_setupModel();
        $ticket = $this->Ticket->find('first', array('order'=>'', 'conditions' => array('AND' => array('Ticket.id' => $id, 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id'))))));
        if (!$id || count($ticket) == 0) {
            $this->Session->setFlash(__d('phkapa', 'Invalid request.'), 'flash_message_error');
            //$this->redirect(array('action' => 'index'));
        }
        
        
        $this->set('ticket', $ticket);
    }

    /**
     * Export
     * Export Excel file with ticket records filtered by date range
     *
     * @return void
     * @access public
     */
    public function export() {
        if (!empty($this->request->data)) {
            $this->Ticket->recursive = 2;
            $this->Ticket->unbindModel(array(
                'hasMany' => array('Children')
                    ), false);
//debug($this->request->data);
            $range['start'] = $this->request->data['Ticket']['startdate'];
            $range['end'] = $this->request->data['Ticket']['enddate'];
// . ' ' . $range['start']['hour'] . ':' . $range['start']['min']  -- . ' ' . $range['end']['hour'] . ':' . $range['end']['min']
            $data = $this->Ticket->find('all', array('order'=>'Ticket.created','conditions' => array('Ticket.origin_date BETWEEN ? AND ?' => array($range['start']['year'] . '-' . $range['start']['month'] . '-' . $range['start']['day'] , $range['end']['year'] . '-' . $range['end']['month'] . '-' . $range['end']['day'] ), "AND" => array('OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id'))))));
            $this->set('tickets', $data);
//debug($data);
            $this->render('xls_data', 'export');
        }
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
