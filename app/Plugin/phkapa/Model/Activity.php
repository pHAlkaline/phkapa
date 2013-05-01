<?php
/**
 * Activity
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
class Activity extends PhkapaAppModel {

    /**
     * Model name
     *
     * @var string
     * @access public
     */
    public $name = 'Activity';

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
     */
    public $validate = array(
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
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

    /* public $hasMany = array(
      'Ticket' => array(
      'className' => 'Phkapa.Ticket',
      'foreignKey' => 'activity_id',
      'dependent' => false,
      'conditions' => array('Ticket.workflow_id <>'=>'5'),
      'fields' => '',
      'order' => '',
      'limit' => '',
      'offset' => '',
      'exclusive' => '',
      'finderQuery' => '',
      'counterQuery' => ''
      )
      ); */

    /**
     * Model associations: hasAndBelongsToMany
     *
     * @var array
     * @access public
     */
    public $hasAndBelongsToMany = array(
        'Process' => array(
            'className' => 'Phkapa.Process',
            'joinTable' => 'phkapa_activities_processes',
            'foreignKey' => 'activity_id',
            'associationForeignKey' => 'process_id',
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