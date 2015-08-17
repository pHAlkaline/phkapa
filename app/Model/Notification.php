<?php

/**
 * Notification
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
App::uses('AuthComponent', 'Controller/Component');

class Notification extends AppModel {

    /**
     * Model name
     *
     * @var string
     * @access public
     */
    public $name = 'Notification';

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
    public $order = 'created ASC';

    /**
     * Validation
     *
     * @var array
     * @access public
     */
    public $validate = array(
        'notifier_id' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Choose one option',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'notified_id' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Choose one option',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'url' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'notification' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
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
        'Notifier' => array(
            'className' => 'User',
            'foreignKey' => 'notifier_id',
            'conditions' => '',
            'fields' => array('id', 'name'),
            'order' => ''
        ),
        'Notified' => array(
            'className' => 'User',
            'foreignKey' => 'notified_id',
            'conditions' => '',
            'fields' => array('id', 'name'),
            'order' => ''
        )
        
        
    );
}

?>