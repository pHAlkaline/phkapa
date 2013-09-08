<?php

/**
 * Tickets controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  PHKAPA
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.phalkaline.eu
 */
class TicketsController extends PhkapaAppController {

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
        $this->paginate=array('order' => array(
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
                        "Supplier.name LIKE" => "%" . $keyword . "%",
                        "Workflow.name LIKE" => "%" . $keyword . "%"),
                )
            );
            $this->set('keyword', $keyword);
        }
        
        $this->set('tickets', $this->paginate());
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
        $this->Ticket->recursive = 2;
        $this->_setupModel();


        $this->set('ticket', $this->Ticket->read(null, $id));
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
                $this->Session->setFlash(__d('phkapa', 'Saved with success.'), 'flash_message_info');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d('phkapa', 'Could not be saved. Please, try again.'), 'flash_message_error');
            }
        }

        if ($ticket_parent != null) {
            // parent ticket must be on workflow 4 or 5 ( Verify or Closed )
            $this->request->data = $this->Ticket->find('first', array('conditions' => array('Ticket.workflow_id' => array('4', '5'), 'Ticket.id' => $ticket_parent)));
            if (!isset($this->request->data['Ticket'])) {
                $this->Session->setFlash(__d('phkapa', 'Invalid request.'), 'flash_message_error');
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
        $registars = $this->Ticket->Registar->find('list', array('conditions' => array('Registar.active' => '1')));
        $processes = $this->Ticket->Process->find('list', $this->processOptions);
        $categories = $this->Ticket->Category->find('list', $this->categoryOptions);
        $causes = $this->Ticket->Cause->find('list', $this->causeOptions);
        $activities = $this->Ticket->Activity->find('list', $this->activityOptions);
        $suppliers = $this->Ticket->Supplier->find('list', array('conditions' => array('Supplier.active' => '1')));
        $origins = $this->Ticket->Origin->find('list', array('conditions' => array('Origin.active' => '1')));
        $workflows = $this->Ticket->Workflow->find('list', array('conditions' => array('Workflow.active' => '1'),'order'=>'Workflow.order'));
        $this->set(compact('types','priorities', 'processes', 'registars', 'activities', 'categories', 'origins', 'workflows', 'causes', 'suppliers'));
    }

    /**
     * Admin edit
     *
     * @param integer $id
     * @return void
     * @access public
     */
    public function admin_edit($id = null) {
        $this->Ticket->recursive=-1;
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__d('phkapa', 'Invalid request.'), 'flash_message_error');
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Ticket->save($this->request->data)) {
                $this->Session->setFlash(__d('phkapa', 'Saved with success.'), 'flash_message_info');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d('phkapa', 'Could not be saved. Please, try again.'), 'flash_message_error');
            }
        }
        if (empty($this->request->data)) {
            
            $this->request->data = $this->Ticket->find('first', array('order'=>''));
        
        }
        $types = $this->Ticket->Type->find('list', array('conditions' => array('Type.active' => '1')));
        $priorities = $this->Ticket->Priority->find('list', array('conditions' => array('Priority.active' => '1')));
        $processes = $this->Ticket->Process->find('list', array('conditions' => array('Process.active' => '1')));
        $registars = $this->Ticket->Registar->find('list', array('conditions' => array('Registar.active' => '1')));
        $activities = $this->Ticket->Activity->find('list', array('conditions' => array('Activity.active' => '1')));
        $categories = $this->Ticket->Category->find('list', array('conditions' => array('Category.active' => '1')));
        $suppliers = $this->Ticket->Supplier->find('list', array('conditions' => array('Supplier.active' => '1')));
        $origins = $this->Ticket->Origin->find('list', array('conditions' => array('Origin.active' => '1')));
        $causes = $this->Ticket->Cause->find('list', array('conditions' => array('Cause.active' => '1')));
        $workflows = $this->Ticket->Workflow->find('list', array('conditions' => array('Workflow.active' => '1'), 'order' => 'Workflow.order'));
        $this->set(compact('types', 'priorities', 'processes', 'registars', 'activities', 'categories', 'origins', 'causes', 'workflows', 'suppliers'));
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
        if ($this->Ticket->delete($id)) {
            $this->Session->setFlash(__d('phkapa', 'Deleted with success.'), 'flash_message_info');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__d('phkapa', 'Could not be deleted.'), 'flash_message_error');
        $this->redirect(array('action' => 'index'));
    }

    
    
    /**
     * Admin export
     * Export Excel file with ticket records filtered by date range
     *
     * @return void
     * @access public
     */
    public function admin_export() {
        if (!empty($this->request->data)) {
            $this->_setupModel();
            $this->Ticket->recursive = 2;
            //debug($this->request->data);
            $range['start'] = $this->request->data['Ticket']['startdate'];
            $range['end'] = $this->request->data['Ticket']['enddate'];

            $data = $this->Ticket->find('all', array('conditions' => array('Ticket.origin_date BETWEEN ? AND ?' => array($range['start']['year'] . '-' . $range['start']['month'] . '-' . $range['start']['day'], 'Ticket.origin_date <=' => $range['end']['year'] . '-' . $range['end']['month'] . '-' . $range['end']['day']))));
            $this->set('tickets', $data);
            //debug($data);
            $this->render('xls_data', 'export');
        }
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
        $this->Ticket->Process->unbindModel(array(
            'hasMany' => array('Ticket'),
            'hasAndBelongsToMany' => array('Activity', 'Category', 'User')
                ), false);
        $this->Ticket->Process->unbindModel(array(
            'hasMany' => array('Role', 'Process')
                ), false);
        $this->Ticket->Registar->unbindModel(array(
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