<?php

/**
 * Tickets controller
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
class TicketsController extends PhkapaAppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array(
        'RequestHandler',
        );

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Tickets';

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
     * Filter from Cause model
     *
     * @var array
     * @access public
     */
    public $causeOptions = array();

    /**
     * Admin index
     *
     * @return void
     * @access public
     */
    public function admin_index() {
        $this->Ticket->recursive = 0;
        $this->paginate = array('order' => array(
                'Priority.order' => 'asc'
        ));
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
                        "Workflow.name LIKE" => "%" . $keyword . "%"),
                
            );
            $this->set('keyword', $keyword);
        }

        $this->set('tickets', $this->Paginator->paginate());
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
        $this->Ticket->recursive = 2;
        $this->_setupModel();


        $this->set('ticket', $this->Ticket->find('first', array('conditions'=>array('Ticket.id'=>$id))));
        $this->set('ticket_revisions', array());
        if (in_array($this->Ticket->name, Configure::read('Revision.tables'))) {
            $this->Ticket->id=$id;
            $this->set('ticket_revisions', $this->Ticket->revisions());
        }
    }

    /**
     * Admin view revision
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function admin_view_revision($id = null, $ticketId = null) {
        if (!$id || !$ticketId || !in_array($this->Ticket->name, Configure::read('Revision.tables'))) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'view', $ticketId));
        }

        $this->Ticket->id = $ticketId;
        $revision = $this->Ticket->revisions(array('conditions' => array('version_id' => $id)));
        $this->set('ticket', $revision[0]);
    }

    /**
     * admin_print_report method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_print_report($id) {
        if (!$id) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->_setupModel();
        $this->Ticket->recursive = 2;
        $ticket = $this->Ticket->find('first', array('order' => '', 'conditions' => array('Ticket.id' => $id)));
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
     * Admin add
     *
     * @param integer $ticket_parent
     * @return void
     * @access public
     */
    public function admin_add($ticket_parent = null) {
        if (!empty($this->request->data) && $this->request->data['Ticket']['filter_change'] == '') {
            $this->Ticket->create();
            if ($this->Ticket->save($this->request->data)) {
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
        $this->request->data['Ticket']['filter_change'] = '';
        $types = $this->Ticket->Type->find('list', array('conditions' => array('Type.active' => '1')));
        $priorities = $this->Ticket->Priority->find('list', array('conditions' => array('Priority.active' => '1')));
        $safeties = $this->Ticket->Safety->find('list', array('conditions' => array('Safety.active' => '1')));
        $registars = $this->Ticket->Registar->find('list', array('conditions' => array('Registar.active' => '1')));
        $processes = $this->Ticket->Process->find('list', $this->processOptions);
        $categories = $this->Ticket->Category->find('list', $this->categoryOptions);
        $causes = $this->Ticket->Cause->find('list', $this->causeOptions);
        $activities = $this->Ticket->Activity->find('list', $this->activityOptions);
        $suppliers = $this->Ticket->Supplier->find('list', array('conditions' => array('Supplier.active' => '1')));
        $origins = $this->Ticket->Origin->find('list', array('conditions' => array('Origin.active' => '1')));
        $workflows = $this->Ticket->Workflow->find('list', array('conditions' => array('Workflow.active' => '1'), 'order' => 'Workflow.order'));
        $closeUsers = $this->Ticket->CloseUser->find('list', array('conditions' => array('CloseUser.active' => '1')));

        $this->set(compact('types', 'priorities', 'safeties', 'processes', 'registars', 'activities', 'categories', 'origins', 'workflows', 'causes', 'suppliers', 'closeUsers'));
    }

    /**
     * Admin edit
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function admin_edit($id = null) {
        $this->Ticket->recursive = 1;
        if (!$id && empty($this->request->data)) {
            $this->Flash->error(__d('phkapa', 'Invalid request.'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Ticket->save($this->request->data)) {
                $this->Flash->info(__d('phkapa', 'Saved with success.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__d('phkapa', 'Could not be saved. Please, try again.'));
            }
        }
        $ticket=$this->Ticket->find('first', array('conditions' => array('Ticket.id' => $id), 'order' => ''));
        if (empty($this->request->data)) {

            $this->request->data = $ticket;
        }
        $types = $this->Ticket->Type->find('list', array('conditions' => array('Type.active' => '1')));
        $priorities = $this->Ticket->Priority->find('list', array('conditions' => array('Priority.active' => '1')));
        $safeties = $this->Ticket->Safety->find('list', array('conditions' => array('Safety.active' => '1')));
        $processes = $this->Ticket->Process->find('list', array('conditions' => array('Process.active' => '1')));
        $registars = $this->Ticket->Registar->find('list', array('conditions' => array('Registar.active' => '1')));
        $activities = $this->Ticket->Activity->find('list', array('conditions' => array('Activity.active' => '1')));
        $categories = $this->Ticket->Category->find('list', array('conditions' => array('Category.active' => '1')));
        $suppliers = $this->Ticket->Supplier->find('list', array('conditions' => array('Supplier.active' => '1')));
        $origins = $this->Ticket->Origin->find('list', array('conditions' => array('Origin.active' => '1')));
        $causes = $this->Ticket->Cause->find('list', array('conditions' => array('Cause.active' => '1')));
        $workflows = $this->Ticket->Workflow->find('list', array('conditions' => array('Workflow.active' => '1'), 'order' => 'Workflow.order'));
        $closeUsers = $this->Ticket->CloseUser->find('list', array('conditions' => array('CloseUser.active' => '1')));
        $ticket=$this->request->data;
        $this->set(compact('ticket','types', 'priorities', 'safeties', 'processes', 'registars', 'activities', 'categories', 'origins', 'causes', 'workflows', 'suppliers', 'closeUsers'));
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
        if ($this->Ticket->delete($id)) {
            $this->Flash->info(__d('phkapa', 'Deleted with success.'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__d('phkapa', 'Could not be deleted.'));
        $this->redirect(array('action' => 'index'));
    }

    /**
     * Admin export
     * Export filtered by date range
     *
     * @return void
     * @access public
     */
    public function admin_export() {
        
    }

    /**
     * admin_export_csv method
     * Export CSV file with ticket records filtered by date range
     *
     * @return void
     * @access public
     */
    public function admin_export_csv() {
        $this->_setupModel();
        $this->Ticket->recursive = 2;
        $range['start'] = $this->request->data['Ticket']['startdate'];
        $range['end'] = $this->request->data['Ticket']['enddate'];

        $data = $this->Ticket->find('all', array('conditions' => array('Ticket.origin_date BETWEEN ? AND ?' => array($range['start']['year'] . '-' . $range['start']['month'] . '-' . $range['start']['day'], 'Ticket.origin_date <=' => $range['end']['year'] . '-' . $range['end']['month'] . '-' . $range['end']['day']))));
        if ($this->request->data['Ticket']['data_to_export'] == 'a') {
            $this->admin_export_csv_actions(Set::extract('/Ticket/id', $data));
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
            'fileName' => 'phkapa_tickets_export.csv'
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
    public function admin_export_csv_actions($tickets) {
        $this->Ticket->Action->recursive = 2;
        $data = $this->Ticket->Action->find('all', array('conditions' => array('ticket_id' => $tickets)));

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
     * Setup Ticket bind model associations 
     * database access performance
     *
     * @return void
     * @access protected
     */
    protected function _setupModel() {
        $this->Ticket->Supplier->unbindModel(array(
            'hasMany' => array('Ticket')
                ), false);
        $this->Ticket->Type->unbindModel(array(
            'hasMany' => array('Ticket')
                ), false);
        $this->Ticket->Priority->unbindModel(array(
            'hasMany' => array('Ticket')
                ), false);
        $this->Ticket->Safety->unbindModel(array(
            'hasMany' => array('Ticket')
                ), false);
        $this->Ticket->Process->unbindModel(array(
            'hasMany' => array('Ticket'),
            'hasAndBelongsToMany' => array('Activity', 'Category', 'User')
                ), false);
        $this->Ticket->Process->unbindModel(array(
            'hasMany' => array('Role', 'Process')
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
        $this->Ticket->Activity->unbindModel(array(
            'hasMany' => array('Ticket'),
            'hasAndBelongsToMany' => array('Process')), false);

        $this->Ticket->Category->unbindModel(array(
            'hasMany' => array('Ticket'),
            'hasAndBelongsToMany' => array('Process')), false);
        $this->Ticket->Origin->unbindModel(array(
            'hasMany' => array('Ticket'),
                ), false);
        $this->Ticket->Cause->unbindModel(array(
            'hasMany' => array('Ticket'),
                ), false);
        $this->Ticket->Workflow->unbindModel(array(
            'hasMany' => array('Ticket'),
                ), false);
        $this->Ticket->Action->unbindModel(array(
            'belongsTo' => array('Ticket'),
                ), false);
    }

    /**
     * Set filter from models : Process , Activity , Category and Cause
     *
     * @return void
     * @access protected
     */
    protected function _setOptions() {

        $user_id = -1;
        if (isset($this->request->data['Ticket']['registar_id']) && $this->request->data['Ticket']['registar_id'] != '') {
            $user_id = $this->request->data['Ticket']['registar_id'];
        }
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
                    'ProcessesUser.user_id = ' . $user_id,
                )
            )
        );

        $this->processOptions['conditions'] = array(
            'Process.active' => '1',
            'User.active' => '1',
            'User.id' => $user_id
        );


        $process_id = -1;
        if ($user_id != -1 && isset($this->request->data['Ticket']['process_id']) && $this->request->data['Ticket']['process_id'] != '') {
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

        $category_id = -1;
        if ($process_id != -1 && isset($this->request->data['Ticket']['category_id']) && $this->request->data['Ticket']['category_id'] != '') {
            $category_id = $this->request->data['Ticket']['category_id'];
        }
        $this->causeOptions['joins'] = array(
            array('table' => 'phkapa_categories_causes',
                'alias' => 'CategoriesCause',
                'type' => 'inner',
                'conditions' => array(
                    'Cause.id = CategoriesCause.cause_id'
                )
            ),
            array('table' => 'phkapa_categories',
                'alias' => 'Category',
                'type' => 'inner',
                'conditions' => array(
                    'CategoriesCause.category_id = ' . $category_id,
                )
            )
        );

        $this->causeOptions['conditions'] = array(
            'Cause.active' => '1',
            'Category.active' => '1'
        );
    }

}

?>
