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
        $ticket = $this->Ticket->find('first', array('order'=>'','conditions' => array('Ticket.workflow_id' => '2', 'Ticket.id' => $id, 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))));
        if (!$id || count($ticket) == 0) {
            $this->Session->setFlash(__d('phkapa', 'Invalid request.'), 'flash_message_error');
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->request->data['Ticket']['approved']==''){
                $this->request->data['Ticket']['approved']=null;
            }
            if ($this->Ticket->save($this->request->data)) {
                $this->Session->setFlash(__d('phkapa', 'Saved with success.'), 'flash_message_info');
                $this->redirect(array('action' => 'index', $id));
            } else {
                $this->Session->setFlash(__d('phkapa', 'Could not be saved. Please, try again.'), 'flash_message_error');
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $ticket;
        }
        $priorities = $this->Ticket->Priority->find('list', array('conditions' => array('Priority.active' => '1')));
        
        $this->set(compact('ticket','priorities'));
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
        $this->_setupModel();
        $ticketCount = $this->Ticket->find('count', array('order'=>'','conditions' => array('Ticket.workflow_id' => '2', 'Ticket.id' => $id, 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))));

        if (!$id || $ticketCount == 0) {
            $this->Session->setFlash(__d('phkapa', 'Invalid request.'), 'flash_message_error');
            $this->redirect(array('action' => 'index'));
        }
        $now=$this->Ticket->timeFormatedField('modified',time());
        if ($this->Ticket->updateAll(array('Ticket.workflow_id' => '3', 'Ticket.modified' => '"'.$now.'"'), array('Ticket.workflow_id' => '2','Ticket.approved' => 1,'Ticket.id' => $id))) {
            $this->Session->setFlash(__d('phkapa', 'Saved with success.'), 'flash_message_info');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__d('phkapa', 'Could not be saved. Please, try again.'), 'flash_message_error');
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
        $this->_setupModel();
        $ticket = $this->Ticket->find('first', array('order'=>'','conditions' => array('Ticket.workflow_id' => '2', 'Ticket.id' => $id, 'OR' => array('Ticket.process_id' => $this->processFilter, 'Ticket.registar_id' => $this->Auth->user('id')))));

        if (!$id || count($ticket) == 0) {
            $this->Session->setFlash(__d('phkapa', 'Invalid request.'), 'flash_message_error');
            $this->redirect(array('action' => 'index'));
        }

        $workflowId = 5;
        $now=$this->Ticket->timeFormatedField('modified',time());
        $nowClose=$this->Ticket->timeFormatedField('close_date',time());
        if (isset($ticket['Ticket']['approved']) && $ticket['Ticket']['approved'] == 0) {
            if ($this->Ticket->updateAll(array('Ticket.workflow_id' => $workflowId, 'Ticket.modified' => '"'.$now.'"', 'Ticket.close_date' => '"'.$nowClose.'"'), array('Ticket.id' => $id, 'Ticket.workflow_id' => '2','Ticket.approved' => 0))) {
                $this->_addNotification($id,__d('phkapa','Ticket # %s has been closed', $id));
                $this->Session->setFlash(__d('phkapa', 'Saved with success.'), 'flash_message_info');
                $this->redirect(array('action' => 'index'));
            }
        }



        $this->Session->setFlash(__d('phkapa', 'Could not be saved. Please, try again.'), 'flash_message_error');
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
            'belongsTo' => array( 'Workflow', 'Parent')
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
