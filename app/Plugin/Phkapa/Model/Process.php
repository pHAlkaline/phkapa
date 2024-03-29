<?php

/**
 * Process
 *
 * PHP version 7
 * 
 * @category Model
 * @package  pHKapa
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.net>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     https://phalkaline.net
 */
class Process extends PhkapaAppModel {

    /**
     * Model name
     *
     * @var string
     * @access public
     */
    public $name = 'Process';

    /**
     * Display Fields for this model
     *
     * @var mixed string or array
     * @access public
     */
    public $displayField = 'name';

    /**
     * Order
     *
     * @var mixed  string or array
     * @access public
     */
    public $order = 'name ASC';

    /**
     * Validation
     *
     * @var array
     * @access public
     */public $validate = array(
        'name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'active' => array(
            'boolean' => array(
                'rule' => array('boolean'),
                'message' => 'Boolean',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );
     /*
    public $hasMany = array(
        'Ticket' => array(
            'className' => 'Phkapa.Ticket',
            'foreignKey' => 'process_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'TicketRevision' => array(
            'className' => 'Phkapa.TicketRevision',
            'foreignKey' => 'process_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
*/
    /**
     * Model associations: hasAndBelongsToMany
     *
     * @var array
     * @access public
     */
    public $hasAndBelongsToMany = array(
        'Activity' => array(
            'className' => 'Phkapa.Activity',
            'joinTable' => 'phkapa_activities_processes',
            'foreignKey' => 'process_id',
            'associationForeignKey' => 'activity_id',
            'unique' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        ),
        'Category' => array(
            'className' => 'Phkapa.Category',
            'joinTable' => 'phkapa_categories_processes',
            'foreignKey' => 'process_id',
            'associationForeignKey' => 'category_id',
            'unique' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        ),
        'User' => array(
            'className' => 'Phkapa.PhkapaUser',
            'joinTable' => 'phkapa_processes_users',
            'foreignKey' => 'process_id',
            'associationForeignKey' => 'user_id',
            'unique' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        )
    );

}

?>