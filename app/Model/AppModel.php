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
    
    public $actsAs = array('Containable');

    public $recursive = -1;

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

    public function beforeDelete($cascade = true) {
        if (!$this->canDelete($this->id)) {
            return false;
        }
        return parent::beforeDelete($cascade);
    }

    public function canDelete($id) {

        $this->name;
        $this->id = $id;
        $canDelete = true;
        foreach ($this->hasMany as $model => $details) {

            if ($details['dependent'] !== true && $model !== 'Comment') {
                if ($details['className'] == $this->name) {
                    $ModelInstance = $this;
                } else {
                    $ModelInstance = $this->{$model};
                }
                $ModelInstance->contain();
                $count = $ModelInstance->find("count", array(
                    "conditions" => array($details['foreignKey'] => $this->id)
                ));
                if ($count) {
                    $canDelete = false;
                }
            }
        }
        foreach ($this->hasAndBelongsToMany as $model => $details) {

            if (isset($details['dependent']) && $details['dependent'] == true) {
                return $canDelete;
            }

            if ($details['with'] == $this->name) {
                $ModelInstance = $this;
            } else {
                $ModelInstance = $this->{$details['with']};
            }
            $ModelInstance->contain();
            $count = $ModelInstance->find("count", array(
                "conditions" => array($details['foreignKey'] => $this->id)
            ));
            if ($count) {
                $canDelete = false;
            }
        }
        return $canDelete;
    }

}
