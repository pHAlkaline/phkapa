<?php

/**
 * Priority
 *
 * PHP version 5
 * 
 * @category Model
 * @package  pHKapa
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */
class Priority extends PhkapaAppModel {

    /**
     * Model name
     *
     * @var string
     * @access public
     */
    public $name = 'Priority';

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
        if (isset($results[0]['Priority'])) {
            foreach ($results as $key => $val) {
                if (isset($val['Priority']['name'])) {
                    $results[$key]['Priority']['name'] = __d('phkapa', $results[$key]['Priority']['name']);
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