<?php
/**
 * Ticket
 *
 * PHP version 5
 * 
 * @category Model
 * @package  PHKAPA
 * @version  RC1
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.phalkaline.eu
 */
class Ticket extends PhkapaAppModel {
    /**
     * Model name
     *
     * @var string
     * @access public
     */
    public $name = 'Ticket';
    /**
     * Display Fields for this model
     *
     * @var mixed string or array
     * @access public
     */
    public $displayField = 'id';
    /**
     * Order
     *
     * @var mixed  string or array
     * @access public
     */
    public $order = array("Priority.order" => "DESC", "Ticket.created" => "DESC");
    /**
     * Validation
     *
     * @var array
     * @access public
     */
    public $validate = array(
        'origin_date' => array(
            'date' => array(
                'rule' => array('date'),
                'message' => 'Invalid date',
            //'allowEmpty' => false
            ),
        ),
        'type_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Choose one option',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'process_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Choose one option',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'priority_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Choose one option',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'registar_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Choose one option',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'activity_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Choose one option',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'category_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Choose one option',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'origin_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Choose one option',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'cause_id' => array(
            'checkWorkflow' => array(
                'rule' => array('checkCause'),
                'message' => 'This workflow requires cause'
            ),
        ),
        'workflow_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Choose one option',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'ticket_parent' => array(
            'checkWorkflow' => array(
                'rule' => array('checkTicketWorkflow'),
                'message' => 'Invalid parent',
                'last' => false
            ),
            'notempty' => array(
                'rule' => array('naturalNumber', true),
                'message' => 'Numeric',
                'allowEmpty' => true,
                'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'close_date' => array(
            'checkWorkflow' => array(
                'rule' => array('checkCloseDateWorkflow'),
                'message' => 'This workflow requires close date',
                
            ),
            'checkCloseDate' => array(
                'rule' => array('checkCloseDate'),
                'message' => 'Close date must be between origin date and today',
                
            ),
            
            'date' => array(
                'rule' => array('date'),
                'message' => 'Invalid date',
                'allowEmpty' => true,
                'required' => false
            ),
        )
    );
    /**
     * Validation 2 for workflow only - Register, Review, Plan, 
     *
     * @var array
     * @access public
     */
    public $validate2 = array(
        'origin_date' => array(
            'date' => array(
                'rule' => array('date'),
                'message' => 'Invalid date',
            //'allowEmpty' => false
            ),
        ),
        'type_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Choose one option',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'process_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Choose one option',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'priority_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Choose one option',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'registar_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Choose one option',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'activity_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Choose one option',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'category_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Choose one option',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'origin_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Choose one option',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'supplier_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Choose one option',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'workflow_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Choose one option',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
        )),
    );
    
    /**
     * Model associations: belongsTo
     *
     * @var array
     * @access public
     */
    public $belongsTo = array(
        'Type' => array(
            'className' => 'Phkapa.Type',
            'foreignKey' => 'type_id',
            'conditions' => '',
            'fields' => array('id', 'name'),
            'order' => ''
        ),
        'Process' => array(
            'className' => 'Phkapa.Process',
            'foreignKey' => 'process_id',
            'conditions' => '',
            'fields' => array('id', 'name'),
            'order' => ''
        ),
        'Priority' => array(
            'className' => 'Phkapa.Priority',
            'foreignKey' => 'priority_id',
            'conditions' => '',
            'fields' => array('id', 'name'),
            'order' => ''
        ),
        'Registar' => array(
            'className' => 'Phkapa.User',
            'foreignKey' => 'registar_id',
            'conditions' => '',
            'fields' => array('id', 'name'),
            'order' => ''
        ),
        'Activity' => array(
            'className' => 'Phkapa.Activity',
            'foreignKey' => 'activity_id',
            'conditions' => '',
            'fields' => array('id', 'name'),
            'order' => ''
        ),
        'Category' => array(
            'className' => 'Phkapa.Category',
            'foreignKey' => 'category_id',
            'conditions' => '',
            'fields' => array('id', 'name'),
            'order' => ''
        ),
        'Supplier' => array(
            'className' => 'Phkapa.Supplier',
            'foreignKey' => 'supplier_id',
            'conditions' => '',
            'fields' => array('id', 'name'),
            'order' => ''
        ),
        'Origin' => array(
            'className' => 'Phkapa.Origin',
            'foreignKey' => 'origin_id',
            'conditions' => '',
            'fields' => array('id', 'name'),
            'order' => ''
        ),
        'Cause' => array(
            'className' => 'Phkapa.Cause',
            'foreignKey' => 'cause_id',
            'conditions' => '',
            'fields' => array('id', 'name'),
            'order' => ''
        ),
        'Workflow' => array(
            'className' => 'Phkapa.Workflow',
            'foreignKey' => 'workflow_id',
            'conditions' => '',
            'fields' => array('id', 'name'),
            'order' => '',
        ),
        'Parent' => array(
            'className' => 'Phkapa.Ticket',
            'foreignKey' => 'ticket_parent',
            'conditions' => '',
            'fields' => array('id'),
            'order' => ''
        )
    );
    
    /**
     * Model associations: hasMany
     *
     * @var array
     * @access public
     */
    public $hasMany = array(
        'Action' => array(
            'className' => 'Phkapa.Action',
            'foreignKey' => 'ticket_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => '',
            'dependent' => true
        ),
        'Children' => array(
            'className' => 'Phkapa.Ticket',
            'foreignKey' => 'ticket_parent',
            'conditions' => '',
            //'fields' => array('id'),
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => '',
            'dependent' => true
        ),
    );

    /**
     * Custom validation rule
     * Check if ticket parent has a valid workflow state
     * A ticket_parent is only valid when its on validation or closed
     *
     * @param array $check field 
     * @access public
     * @return boolean
     */
    public function checkTicketWorkflow($check) {
        if ($check['ticket_parent'] == null)
            return true;
        $count = $this->find('count', array('conditions' => array('Ticket.workflow_id' => array('4', '5'), 'Ticket.id' => $check['ticket_parent'])));
        if ($count == 0)
            return false;
        return true;
    }

    /**
     * Custom validation rule
     * Check if close date is valid , beetween ticket origin date and today
     *
     * @param array $check field 
     * @access public
     * @return boolean
     */
    public function checkCloseDate($check) {
        
        
        if ($check['close_date']==null) return true;
        
        $close_date = strtotime($check['close_date']);
        $origin_date=strtotime($this->data['Ticket']['origin_date']);
        $today = strtotime(Date('Y-m-d H:i:s'));
        
        if ($close_date > $today) {
            return false;
        }
        
        if ($close_date < $origin_date) {
            return false;
        }
        
        return true;
    }

    /**
     * Custom validation rule
     * Check if close date is required
     * If ticket is closed is required
     *
     * @param array $check field 
     * @access public
     * @return boolean
     */
    public function checkCloseDateWorkflow($check) {
        return ($this->data['Ticket']['workflow_id'] == 5 && $check['close_date'] == null) ? false : true;
    }

    /**
     * Custom validation rule
     * Check if cause is required
     * If ticket is on workflow validation ou closed cause is required
     *
     * @param array $check field 
     * @access public
     * @return boolean
     */
    public function checkCause($check) {
        return ($this->data['Ticket']['workflow_id'] > 3 && $check['cause_id'] == null) ? false : true;
    }

    /**
     * beforeSave callback
     * If Ticket workflow is not closed sets close date no null
     *
     * @param array $options
     * @access public
     * @return array
     */
    public function beforeSave($options = array()) {
        if (isset($this->data['Ticket']['workflow_id']) && $this->data['Ticket']['workflow_id'] != 5) {
            $this->data['Ticket']['close_date'] = null;
        }
        return true;
    }

}

?>