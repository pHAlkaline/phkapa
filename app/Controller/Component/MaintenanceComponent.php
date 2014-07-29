<?php

App::uses('Component', 'Controller');

/**
 * PHKAPA Component
 *
 * PHP version 5
 *
 * @category Component
 * @package  PHKAPA
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */
class MaintenanceComponent extends Component {

    /**
     * Other components utilized by MaintenanceComponent
     *
     * @var array
     * @access public
     */
    public $components = array('Session');

    /**
     * The name of the element used for SessionComponent::setFlash
     *
     * @var string
     * @access public
     */
    public $flashElement = 'flash_message_maintenace';

    /**
     * Message to display when app is on maintenance mode.  For security purposes.
     *
     * @var string
     * @access public
     */
    public $maintenanceMessage = null;

    /**
     * Parameter data from Controller::$params
     *
     * @var array
     * @access public
     */
    public $params = array();

    /**
     * startup
     * called after Controller::beforeFilter()
     * 
     * @param object $controller instance of controller
     * @return void
     * @access public
     */
    public function startup(Controller $controller) {
        if ($this->isOn() && strpos($controller->here,Configure::read('Maintenance.site_offline_url'))===false) {
            $controller->redirect(Router::url(Configure::read('Maintenance.site_offline_url')));
            return;
        }

        if ($this->hasSchedule()) {
            $this->Session->setFlash(__('This application will be on maintenance mode at  %s ', Configure::read('Maintenance.start')), $this->flashElement, array(), 'maintenance');
        }
    }

    /**
     * isOn
     * is maintenance on
     * 
     * @access public
     * @return boolean
     * 
     */
    public function isOn() {
        if ((Configure::read('Maintenance.start') != '') && (Configure::read('Maintenance.duration') != '')) {

            $date1 = time();
            $date2 = strtotime(Configure::read('Maintenance.start'));
            $interval = ($date1 - $date2) / (60 * 60);
            if ($interval > 0 && $interval < Configure::read('Maintenance.duration'))
                return true;
        }
        return false;
    }

    /**
     * hasSchedule
     * has maintenance schedule
     * 
     * @return boolean
     * @access public
     */
    public function hasSchedule() {
        if ((Configure::read('Maintenance.start') != '') && (Configure::read('Maintenance.duration') != '')) {
            $date1 = time();
            $date2 = strtotime(Configure::read('Maintenance.start'));
            $interval = ($date1 - $date2) / (60 * 60);
            if ($interval < 0)
                return true;
        }
        return false;
    }

    /**
     * start
     * maintenance start date
     * 
     * @access public
     * @return string
     */
    public function start() {
        return Configure::read('Maintenance.start');
    }

    /**
     * end
     * maintenance end date
     * 
     * @return string
     * @access public
     */
    public function end() {
        return Configure::read('Maintenance.duration');
    }

}

?>