<?php
/**
 * Application model
 *
 * This file is the base model of all other models
 *
 * PHP version 5
 * 
 * @category Models
 * @package  pHKapa
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */
App::uses('Model', 'Model');
class AppModel extends Model {
    public $recursive=-1;
    /**
     * Model revision version_description
     *
     * @var string
     * @access public
     */
    public $version_description = null;
    /**
     * Model revision version_request
     *
     * @var string
     * @access public
     */
     public $version_request = null;
}
