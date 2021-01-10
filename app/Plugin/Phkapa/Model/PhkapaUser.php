<?php

/**
 * User
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
class PhkapaUser extends PhkapaAppModel {

    /**
     * Model name
     *
     * @var string
     * @access public
     */
    public $name = 'User';

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
     * Table prefix for model table
     *
     * @var string
     * @access public
     */
    public $tablePrefix = null;

    /**
     * Model associations: hasAndBelongsToMany
     *
     * @var array
     * @access public
     */
    public $hasAndBelongsToMany = array(
        'Process' => array(
            'className' => 'Phkapa.Process',
            'joinTable' => 'phkapa_processes_users',
            'foreignKey' => 'user_id',
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