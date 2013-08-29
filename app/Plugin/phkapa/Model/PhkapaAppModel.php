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
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.phalkaline.eu
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

    public function timeFormatedField($updateCol, $time) {

        $db = $this->getDataSource();
        $now = $time;
        $default = array('formatter' => 'date');
        $colType = array_merge($default, $db->columns[$this->getColumnType($updateCol)]);
        if (!array_key_exists('format', $colType)) {
            $time = $now;
        } else {
            $time = call_user_func($colType['formatter'], $colType['format']);
        }
        return $time;
    }

}

?>
