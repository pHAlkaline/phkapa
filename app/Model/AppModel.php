<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP version 5
 * 
 * @category Models
 * @package  pHKapa
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.net>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */
App::uses('Model', 'Model');
App::uses('CakeLog', 'Log');

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

    /*
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
      return false;
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
      return false;
      }
      }
      return true;
      }
     */

    public function delete($id = null, $cascade = true) {
        try {
            parent::delete($id, $cascade);
        } catch (Exception $exception) {
            CakeLog::write(LOG_ERR, static::_getMessage($exception));
            return false;
        }
        return true;
    }

    /**
     * Generates a formatted error message
     *
     * @param Exception $exception Exception instance
     * @return string Formatted message
     */
    protected static function _getMessage($exception) {
        $message = sprintf("[%s] %s", get_class($exception), $exception->getMessage()
        );
        if (method_exists($exception, 'getAttributes')) {
            $attributes = $exception->getAttributes();
            if ($attributes) {
                $message .= "\nException Attributes: " . var_export($exception->getAttributes(), true);
            }
        }
        if (PHP_SAPI !== 'cli') {
            $request = Router::getRequest();
            if ($request) {
                $message .= "\nRequest URL: " . $request->here();
            }
        }
        $message .= "\nStack Trace:\n" . $exception->getTraceAsString();
        return $message;
    }

}
