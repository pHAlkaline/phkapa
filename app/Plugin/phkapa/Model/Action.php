<?php

/**
 * Action
 *
 * PHP version 5
 * 
 * @category Model
 * @package  PHKAPA
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */
class Action extends PhkapaAppModel {
    public $actsAs = array('Revision');
    /**
     * Model name
     *
     * @var string
     * @access public
     */
    public $name = 'Action';

    /**
     * Display Fields for this model
     *
     * @var mixed string or array
     * @access public
     */
    public $displayField = 'action_type_id';

    /**
     * Order
     *
     * @var mixed  string or array
     * @access public
     */
    public $order = 'Action.id DESC';

    /**
     * Validation
     *
     * @var array
     * @access public
     */
    public $validate = array(
        'ticket_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Choose one option',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'action_type_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Choose one option',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'action_effectiveness_id' => array(
            'validEffectiveness' => array(
                'rule' => array('validEffectiveness'),
                'message' => 'Action type requires verification on close',
                'required' => false,
            ),
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Choose one option',
                'allowEmpty' => true,
                'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'verify_user_id' => array(
            'checkWorkflow' => array(
                'rule' => array('checkVerifyUserByEffectivenessStatus'),
                'message' => 'Action type requires verified by',
                
            ),
            
        ),
        'description' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'deadline' => array(
            'numeric' => array(
                'rule' => array('naturalNumber', true),
                'message' => 'Numeric',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'closed' => array(
            'boolean' => array(
                'rule' => array('boolean'),
                'message' => 'Boolean',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'close_date' => array(
            'checkWorkflow' => array(
                'rule' => array('checkCloseDate'),
                'message' => 'Action is closed, must have closed date',
                'required' => false
            ),
            'checkValidCloseDate' => array(
                'rule' => array('checkValidCloseDate'),
                'message' => 'Must be between ticket origin date and ticket close date',
                'required' => false
            ),
            'date' => array(
                'rule' => array('date'),
                'message' => 'Invalid date',
                'allowEmpty' => true,
                'required' => false
            ),
        ),
        'close_user_id' => array(
            'checkWorkflow' => array(
                'rule' => array('checkCloseUserByCloseStatus'),
                'message' => 'Action requires closed by',
                
            ),
            
        ),
    );

    /**
     * Model associations: belongsTo
     *
     * @var array
     * @access public
     */
    public $belongsTo = array(
        'Ticket' => array(
            'className' => 'Phkapa.Ticket',
            'foreignKey' => 'ticket_id',
            'fields' => array('id'),
            'order' => '',
            'type' => 'INNER'
        ),
        'ActionType' => array(
            'className' => 'Phkapa.ActionType',
            'foreignKey' => 'action_type_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'ActionEffectiveness' => array(
            'className' => 'Phkapa.ActionEffectiveness',
            'foreignKey' => 'action_effectiveness_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'VerifyUser' => array(
            'className' => 'Phkapa.User',
            'foreignKey' => 'verify_user_id',
            'conditions' => '',
            'fields' => array('id', 'name'),
            'order' => ''
        ),
        'CloseUser' => array(
            'className' => 'Phkapa.User',
            'foreignKey' => 'close_user_id',
            'conditions' => '',
            'fields' => array('id', 'name'),
            'order' => ''
        ),
        
        'ModifiedUser' => array(
            'className' => 'Phkapa.User',
            'foreignKey' => 'modified_user_id',
            'conditions' => '',
            'fields' => array('id', 'name'),
            'order' => ''
        ),
    );

    /**
     * Custom validation rule
     * Check if action type must be evaluated and is evaluated
     *
     * @param array $check field 
     * @access public
     * @return boolean
     */
    public function validEffectiveness($check) {

        $result = true;
        if (isset($this->data['Action']['closed']) && $this->data['Action']['closed'] == true) {
            $this->Ticket->recursive = 0;

            $ticket = $this->Ticket->find('first', array('fields' => array('Ticket.workflow_id'), 'conditions' => array('Ticket.id' => $this->data['Action']['ticket_id'])));
            if ($ticket['Ticket']['workflow_id'] < 5)
                return true;

            $this->ActionType->recursive = 0;
            $actionType = $this->ActionType->findById($this->data['Action']['action_type_id']);

            //debug($actionType);
            if ($actionType['ActionType']['verification'] && $this->data['Action']['action_effectiveness_id'] == null)
                return false;
        }
        return true;
    }

    /**
     * Custom validation rule
     * Check if close date is required and its set
     *
     * @param array $check field 
     * @access public
     * @return boolean
     */
    public function checkCloseDate($check) {
        return ($this->data['Action']['closed'] == true && $check['close_date'] == null) ? false : true;
    }

    /**
     * Custom validation rule
     * Check if close date is valid
     *
     * @param array $check field 
     * @access public
     * @return boolean
     */
    public function checkValidCloseDate($check) {
        //debug($check);
        if ($check['close_date'] == null){
            return true;
        }
        $this->Ticket->recursive = 0;
        $ticket = $this->Ticket->find('first', array('fields' => array('Ticket.close_date', 'Ticket.origin_date'), 'conditions' => array('Ticket.id' => $this->data['Action']['ticket_id'])));


        $close_date = strtotime($check['close_date']);
        $origin_date = strtotime($ticket['Ticket']['origin_date']);
        $ticket_close_date = strtotime($ticket['Ticket']['close_date']);
        $today = strtotime(Date('Y-m-d H:i:s'));

        //debug('close_date: ' . $close_date .' '.$check['close_date']);
        //debug('origin_date' . $origin_date .' '.$ticket['Ticket']['origin_date']);
        //debug('ticket close' . $ticket_close_date .' '.$ticket['Ticket']['close_date']);
        //debug('today'. $today .' '.Date('Y-m-d'));

        if ($close_date > $today) {
            //debug('rule1');
            return false;
        }

        if ($close_date < $origin_date) {
            //debug('rule2');
            return false;
        }

        if ($ticket_close_date == '') {
            //debug('rule3');
            return true;
        }

        if ($close_date > $ticket_close_date) {
            //debug('rule4');
            return false;
        }

        return true;
    }
    
    /**
     * Custom validation rule
     * Check if close_user_id is required
     * If action is closed is required
     *
     * @param array $check field 
     * @access public
     * @return boolean
     */
    public function checkCloseUserByCloseStatus($check) {
        return ($this->data['Action']['closed'] == true && $check['close_user_id'] == null) ? false : true;
    }
    
    /**
     * Custom validation rule
     * Check if verify_user_id is required
     * If action is verified is required
     *
     * @param array $check field 
     * @access public
     * @return boolean
     */
    public function checkVerifyUserByEffectivenessStatus($check) {
        return ($this->data['Action']['action_effectiveness_id'] != null && $check['verify_user_id'] == null) ? false : true;
    }

    /**
     * beforeSave callback
     * Sets close date to null if closed field if flase.
     *
     * @param array $options model options
     * @access public
     * @return boolean
     */
    public function beforeSave($options = array()) {
        if (isset($this->data['Action']['closed']) && $this->data['Action']['closed'] != true) {
            $this->data['Action']['close_date'] = null;
            $this->data['Action']['close_user_id'] = null;
        }
        $this->data['Action']['modified_user_id']=AuthComponent::user('id');
        return true;
    }
    
    

}

?>