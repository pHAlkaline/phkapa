<?php

App::uses('Component', 'Controller');

/**
 * pHKapa Component
 *
 * PHP version 7
 *
 * @category Component
 * @package  pHKapa.app.Controller.Component
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.net>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     https://phalkaline.net
 */
class MaintenanceComponent extends Component {

    /**
     * Other components utilized by MaintenanceComponent
     *
     * @var array
     * @access public
     */
    public $components = array('Session','Flash');

    /**
     * The name of the element used for SessionComponent::setFlash
     *
     * @var string
     * @access public
     */
    public $flashElement = 'warning';

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

        // Maintenance mode OFF but on offline page -> redirect to root url    
        if (!$this->isOn() && strpos($controller->here, Configure::read('Maintenance.site_offline_url')) !== false) {
            $controller->redirect(Router::url('/', true));
            return;
        }

        // Maintenance mode ON user logoout allowed
        if ($this->isOn() && strpos($controller->here, 'users/logout') !== false) {
            return;
        }

        // Maintenance mode ON but not in offline page requested - > redirect to offline page
        if ($this->isOn() && strpos($controller->here, Configure::read('Maintenance.site_offline_url')) === false) {

            // All users auto logged off if setting is true
            if (Configure::read('Maintenance.offline_destroy_session')) {
                $this->Session->destroy();
            }

            $controller->redirect(Router::url(Configure::read('Maintenance.site_offline_url'), true));
            return;
        }

        // Maintenance mode scheduled show message!!    
        if ($this->hasSchedule()) {
            $this->Flash->maintenance(__('This application will be on maintenance mode at  %s ', Configure::read('Maintenance.start')));
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

            $tzNow = new DateTime();
            $tzNow->setTimezone(new DateTimeZone(Configure::read('Config.timezone')));
            $date = $tzNow->format('d-m-Y H:i:s');
            $date1 = strtotime($date);
            $date2 = strtotime(Configure::read('Maintenance.start'));
            $interval = ($date1 - $date2) / (60 * 60);
            if ($interval > 0 && $interval < Configure::read('Maintenance.duration')) {
                return true;
            }
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