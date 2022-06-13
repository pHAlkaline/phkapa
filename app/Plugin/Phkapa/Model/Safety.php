<?php

/**
 * Safety
 *
 * PHP version 5
 * 
 * @category Model
 * @package  pHKapa
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.net>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */
class Safety extends PhkapaAppModel {

    /**
     * Model name
     *
     * @var string
     * @access public
     */
    public $name = 'Safety';

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
    public $order = array('order ASC', 'name ASC');

    /**
     * Validation
     *
     * @var array
     * @access public
     */
    public $validate = array(
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
        'order' => array(
            'boolean' => array(
                'rule' => array('naturalNumber'),
                'message' => 'Numeric',
                'allowEmpty' => false,
                'required' => true,
                
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'required' => true,
                'message' => 'Order already taken',
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
            'foreignKey' => 'safety_id',
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
            'foreignKey' => 'safety_id',
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
     * afterFind callback
     * translates model name field
     *
     * @param array $results
     * @param boolean $primary
     * @access public
     * @return array
     */
    public function afterFind($results, $primary = false) {
        if (isset($results[0]['Safety'])) {
            foreach ($results as $key => $val) {
                if (isset($val['Safety']['name'])) {
                    $results[$key]['Safety']['name'] = __d('phkapa', $results[$key]['Safety']['name']);
                }
            }
        }
        if (isset($results['name'])) {
            $results['name'] = __d('phkapa', $results['name']);
        }

        return $results;
    }

}

?>