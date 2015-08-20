<?php

/**
 * Register controller
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
class RegisterController extends PhkapaAppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Register';

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
     * Filter for Ticket -> Process model ( User process related )
     *
     * @var array
     * @access public
     */
    public $processFilter = array();

    /**
     * List of Helpers for this Controller
     *
     * @var array
     * @access public
     */
    public $helpers = array('Js' => array('Jquery'));

    /**
     * Index
     *
     * @return void
     * @access public
     */
    public function index() {
        $this->Ticket->recursive = 0;
        $this->Paginator->settings = array('order' => 'Priority.order', 'conditions' => array('Ticket.workflow_id' => '1','AND' => array('OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))));
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
        $this->Ticket->recursive = 0;
        if (!$id || $this->ticketAllowed() == 0){
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('ticket', $ticket);
    }

    /**
     * add
     *
     * @param integer $ticket_parent
     * @return void
     * @access public
     */
    public function add($ticket_parent = null) {

        if (!empty($this->request->data) && $this->request->data['Ticket']['process_change'] == '') {
            $this->Ticket->create();
            //$this->request->data['Ticket']['uuid'] = date('YmdHis');
            $this->request->data['Ticket']['registar_id'] = $this->Auth->user('id');
            $this->request->data['Ticket']['workflow_id'] = 1;
            if ($this->Ticket->save($this->request->data)) {
                $this->_addNotification($this->Ticket->id, __d('phkapa', 'New ticket registered') . ' #' . $this->Ticket->id);
                $this->Flash->info(__d('phkapa', 'Saved with success.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__d('phkapa', 'Could not be saved. Please, try again.'));
            }
        }

        if ($ticket_parent != null) {
            // parent ticket must be on workflow 4 or 5 ( Verify or Closed )
            $this->request->data = $this->Ticket->find('first', array('conditions' => array('Ticket.workflow_id' => array('4', '5'), 'Ticket.id' => $ticket_parent)));
            if (!isset($this->request->data['Ticket'])) {
                $this->Flash->error(__d('phkapa', 'Invalid request.'));
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data['Ticket']['ticket_parent'] = $ticket_parent;
            unset($this->request->data['Ticket']['id']);
            unset($this->request->data['Ticket']['cause_id']);
            unset($this->request->data['Ticket']['cause_notes']);
            unset($this->request->data['Ticket']['created']);
            unset($this->request->data['Ticket']['modified']);
        }
        $this->_setOptions();


        $this->request->data['Ticket']['process_change'] = '';
        $types = $this->Ticket->Type->find('list', array('conditions' => array('Type.active' => '1')));
        $priorities = $this->Ticket->Priority->find('list', array('conditions' => array('Priority.active' => '1')));
        $safeties = $this->Ticket->Safety->find('list', array('conditions' => array('Safety.active' => '1')));
        $suppliers = $this->Ticket->Supplier->find('list', array('conditions' => array('Supplier.active' => '1')));
        $processes = $this->Ticket->Process->find('list', array('conditions' => array('Process.active' => '1')));
        $activities = $this->Ticket->Activity->find('list', $this->activityOptions);


        $categories = $this->Ticket->Category->find('list', $this->categoryOptions);
        $origins = $this->Ticket->Origin->find('list', array('conditions' => array('Origin.active' => '1')));
        $this->set(compact('types', 'priorities', 'safeties', 'processes', 'registars', 'activities', 'categories', 'origins', 'workflows', 'suppliers'));
    }

    /**
     * update by progress , used on AJAX calls to update add / edit form 
     *
     * @return void
     * @access public
     */
    public function update_by_process() {
        Configure::write('debug', 0);
        if ($this->request->isAjax()) {
            $this->_setOptions();
            $this->request->data['Ticket']['process_change'] = '';
            $this->request->data['Ticket']['activity_id'] = 3;
            $activities = $this->Ticket->Activity->find('list', $this->activityOptions);
            $categories = $this->Ticket->Category->find('list', $this->categoryOptions);
            $this->set(compact('activities', 'categories'));
        }
    }

    /**
     * edit
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function edit($id = null) {
        $this->Ticket->recursive = -1;
        $this->Ticket->order = null;
        if ((!$id && empty($this->request->data)) || $this->ticketAllowed($id) == 0) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data) && $this->request->data['Ticket']['process_change'] == '') {
            $this->request->data['Ticket']['registar_id'] = $this->Auth->user('id');
            $this->request->data['Ticket']['workflow_id'] = 1;

            if (isset($this->request->data['Ticket']['ticket_parent']) && $this->request->data['Ticket']['ticket_parent'] != '') {
                // parent ticket must be on workflow 4 or 5 ( Verify or Closed )
                $validTicketParent = $this->Ticket->find('count', array('conditions' => array('Ticket.workflow_id' => array('4', '5'), 'Ticket.id' => $this->request->data['Ticket']['ticket_parent'])));
                if ($validTicketParent == 0) {
                    $this->Flash->error(__d('phkapa', 'Invalid request.'));
                    $this->redirect(array('action' => 'index'));
                }
            }


            if ($this->Ticket->save($this->request->data)) {
                $this->Flash->info(__d('phkapa', 'Saved with success.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__d('phkapa', 'Could not be saved. Please, try again.'));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $ticket; //$this->Ticket->read(null, $id);
        }

        $this->_setOptions();
        $this->request->data['Ticket']['process_change'] = '';
        $types = $this->Ticket->Type->find('list', array('conditions' => array('Type.active' => '1')));
        $priorities = $this->Ticket->Priority->find('list', array('conditions' => array('Priority.active' => '1')));
        $safeties = $this->Ticket->Safety->find('list', array('conditions' => array('Safety.active' => '1')));
        $suppliers = $this->Ticket->Supplier->find('list', array('conditions' => array('Supplier.active' => '1')));
        $processes = $this->Ticket->Process->find('list', array('conditions' => array('Process.active' => '1')));
        $activities = $this->Ticket->Activity->find('list', $this->activityOptions);
        $categories = $this->Ticket->Category->find('list', $this->categoryOptions);
        $origins = $this->Ticket->Origin->find('list', array('conditions' => array('Origin.active' => '1')));
        $this->set(compact('types', 'priorities', 'safeties', 'processes', 'registars', 'activities', 'categories', 'origins', 'workflows', 'suppliers'));
    }

    /**
     * delete
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function delete($id = null) {
        $this->Ticket->recursive = -1;
        $this->Ticket->order = null;
        if (!$id || $this->ticketAllowed() == 0) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Ticket->deleteAll(array('Ticket.id' => $id))) {
            $this->Flash->info(__d('phkapa', 'Deleted with success.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__d('phkapa', 'Could not be deleted.'));
        $this->redirect(array('action' => 'index'));
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
        
        if (!$id || $this->ticketAllowed() == 0) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }

        //$now = $this->Ticket->timeFormatedField('modified', time());
        $this->Ticket->read(null, $id);
        $this->Ticket->set(array(
            'workflow_id' => 2,
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
     * Set filter from models : Process , Activity , Category
     *
     * @return void
     * @access protected
     */
    protected function _setOptions() {

        $this->_setProcessOptions();
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
     * Set filter from models : Process to apply on Tickets with only user "has" process relation
     *
     * @return void
     * @access protected
     */
    protected function _setProcessOptions() {

        $this->processOptions['joins'] = array(
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

        $this->processOptions['conditions'] = array(
            //'Process.active' => '1',
            //'User.active' => '1',
            'User.id' => $this->Auth->user('id')
        );

        //$this->loadModel('Phkapa.Process');
        $this->processFilter = array_flip($this->Ticket->Process->find('list', $this->processOptions));

        $this->processOptions['conditions'] = array(
            'Process.active' => '1',
            'User.id' => $this->Auth->user('id')
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
        // belongsTo 'Type','Process','Registar','Activity','Category','Supplier','Origin','Cause','Workflow','Parent'
        $this->Ticket->unbindModel(array(
            'belongsTo' => array('Workflow', 'Parent')
                ), false);


        // hasMany 'Action',  'Children'
        $this->Ticket->unbindModel(array(
            'hasMany' => array('Children')
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
    
    
    protected function ticketAllowed($id=null){
        return $this->Ticket->find('count', array('order' => '', 'conditions' => array('Ticket.workflow_id' => '1', 'Ticket.id' => $id, 'AND' => array( 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id'))))));
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
        $this->_setupModel();
    }

}

?>
