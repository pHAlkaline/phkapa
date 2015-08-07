<?php

/**
 * Review controller
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
class ReviewController extends PhkapaAppController {

    /**
     * List of Components for this Controller
     *
     * @var array
     * @access public
     */
    public $components = array('RequestHandler');

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Review';

    /**
     * List of Models for this Controller
     *
     * @var array
     * @access public
     */
    public $uses = array('Phkapa.Ticket');

    /**
     * Filter from Category model
     *
     * @var array
     * @access public
     */
    public $categoryOptions = array();

    /**
     * Filter from Activity model
     *
     * @var array
     * @access public
     */
    public $activityOptions = array();

    /**
     * Filter from Process model
     *
     * @var array
     * @access public
     */
    public $processOptions = array();

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
        $this->Ticket->recursive = 0;
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
            $this->paginate = array('conditions' => array
                    ("OR" => array(
                        "Ticket.id LIKE" => "%" . $keyword . "%",
                        "Priority.name LIKE" => "%" . $keyword . "%",
                        "Type.name LIKE" => "%" . $keyword . "%",
                        "Process.name LIKE" => "%" . $keyword . "%",
                        "Origin.name LIKE" => "%" . $keyword . "%",
                        "Category.name LIKE" => "%" . $keyword . "%",
                        "Activity.name LIKE" => "%" . $keyword . "%",
                        "Cause.name LIKE" => "%" . $keyword . "%",
                        "Supplier.name LIKE" => "%" . $keyword . "%"),
                    "AND" => array('Ticket.workflow_id' => '2', 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id'))))
            );
            $this->set('keyword', $keyword);
        } else {
            $this->paginate = array('conditions' => array('Ticket.workflow_id' => '2', 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id'))));
        }

        $this->set('tickets', $this->paginate());
    }

    /**
     * edit
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function edit($id = null) {
        $this->Ticket->recursive = 0;
        $this->_setupModel();
        $ticket = $this->Ticket->find('first', array('order' => '', 'conditions' => array('Ticket.workflow_id' => '2', 'Ticket.id' => $id, 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))));
        if (!$id || count($ticket) == 0) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->request->data['Ticket']['approved'] == '') {
                $this->request->data['Ticket']['approved'] = null;
            }
            if ($this->Ticket->save($this->request->data)) {
                $this->Flash->info(__d('phkapa', 'Saved with success.'));
                $this->redirect(array('action' => 'index', $id));
            } else {
                $this->Flash->error(__d('phkapa', 'Could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $ticket;
        }
        $priorities = $this->Ticket->Priority->find('list', array('conditions' => array('Priority.active' => '1')));
        $safeties = $this->Ticket->Safety->find('list', array('conditions' => array('Safety.active' => '1')));
        $this->_setOptions();
        $this->request->data['Ticket']['process_change'] = '';
        $types = $this->Ticket->Type->find('list', array('conditions' => array('Type.active' => '1')));
        $suppliers = $this->Ticket->Supplier->find('list', array('conditions' => array('Supplier.active' => '1')));
        $processes = $this->Ticket->Process->find('list', array('conditions' => array('Process.active' => '1')));
        $activities = $this->Ticket->Activity->find('list', $this->activityOptions);
        $categories = $this->Ticket->Category->find('list', $this->categoryOptions);
        $origins = $this->Ticket->Origin->find('list', array('conditions' => array('Origin.active' => '1')));
        $this->set(compact('ticket', 'types', 'priorities', 'safeties', 'processes', 'registars', 'activities', 'categories', 'origins', 'workflows', 'suppliers'));
    }

    /**
     * send
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function send($id = null) {
        $this->Ticket->recursive = -1;
        $this->Ticket->order = null;
        $this->_setupModel();
        $ticketCount = $this->Ticket->find('count', array('order' => '', 'conditions' => array('Ticket.approved' => 1, 'Ticket.workflow_id' => '2', 'Ticket.id' => $id, 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))));

        if (!$id || $ticketCount == 0) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        //$now = $this->Ticket->timeFormatedField('modified', time());
        $this->Ticket->read(null, $id);
        $this->Ticket->set(array(
            'workflow_id' => 3,
            'modified_user_id' => $this->Auth->user('id')
        ));
        if ($this->Ticket->save()) {
            $this->Flash->info(__d('phkapa', 'Saved with success.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__d('phkapa', 'Could not be saved. Please, try again.'));
        $this->redirect(array('action' => 'index'));
    }

    /**
     * close
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function close($id = null) {
        $this->Ticket->recursive = -1;
        $this->Ticket->order = null;
        $this->_setupModel();
        $ticket = $this->Ticket->find('first', array('order' => '', 'conditions' => array('Ticket.approved' => '0', 'Ticket.workflow_id' => '2', 'Ticket.id' => $id, 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))));

        if (!$id || count($ticket) == 0) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }

        $workflowId = 5;
        $now = $this->Ticket->timeFormatedField('modified', time());
        $nowClose = $this->Ticket->timeFormatedField('close_date', time());
        $this->Ticket->read(null, $id);
        $this->Ticket->set(array(
            'workflow_id' => $workflowId,
            'close_date' => $nowClose,
            'close_user_id' => $this->Auth->user('id'),
            'modified_user_id' => $this->Auth->user('id')
        ));
        if ($this->Ticket->save()) {
            $this->_addNotification($id, __d('phkapa', 'Ticket # %s has been closed', $id));
            $this->Flash->info(__d('phkapa', 'Saved with success.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__d('phkapa', 'Could not be saved. Please, try again.'));
        $this->redirect(array('action' => 'index'));
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
            'belongsTo' => array('Workflow', 'Parent')
                ), false);


        // hasMany 'Action',  'Children'
        $this->Ticket->unbindModel(array(
            'hasMany' => array('Children')
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
     * Set filter from models : Process , Activity , Category
     *
     * @return void
     * @access protected
     */
    protected function _setOptions() {


        $process_id = -1;
        if (isset($this->request->data['Ticket']['process_id']) && $this->request->data['Ticket']['process_id'] != '') {
            $process_id = $this->request->data['Ticket']['process_id'];
        }

        $this->activityOptions['joins'] = array(
            array('table' => 'phkapa_activities_processes',
                'alias' => 'ActivitiesProcess',
                'type' => 'inner',
                'conditions' => array(
                    'Activity.id = ActivitiesProcess.activity_id'
                )
            ),
            array('table' => 'phkapa_processes',
                'alias' => 'Process',
                'type' => 'inner',
                'conditions' => array(
                    'ActivitiesProcess.Process_id = ' . $process_id,
                )
            )
        );

        $this->activityOptions['conditions'] = array(
            'Activity.active' => '1',
            'Process.active' => '1'
        );

        $this->categoryOptions['joins'] = array(
            array('table' => 'phkapa_categories_processes',
                'alias' => 'CategoriesProcess',
                'type' => 'inner',
                'conditions' => array(
                    'Category.id = CategoriesProcess.category_id'
                )
            ),
            array('table' => 'phkapa_processes',
                'alias' => 'Process',
                'type' => 'inner',
                'conditions' => array(
                    'CategoriesProcess.Process_id = ' . $process_id,
                )
            )
        );

        $this->categoryOptions['conditions'] = array(
            'Category.active' => '1',
            'Process.active' => '1'
        );
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
