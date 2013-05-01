<?php
/**
 * Phkapa Plugin Application model
 *
 * This file is the base model of all other models
 *
 * PHP version 5
 * 
 * @category Models
 * @package  PHKAPA
 * @version  RC1
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.phalkaline.eu
 */
class PhkapaAppModel extends AppModel {
    /**
     * Table prefix for model table
     *
     * @var string
     * @access public
     */
    
    public $tablePrefix = 'phkapa_';
    /**
     * Validation domain for models validation error strings
     * used for translation
     *
     * @var string
     * @access public
     */
    public $validationDomain = 'phkapa';
    
}
?>
