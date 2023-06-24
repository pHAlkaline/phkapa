<?php

App::uses('Component', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('Notification', 'Model');

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
class NotifyComponent extends Component {

    /**
     * Other components required by NotifyComponent
     *
     * @var array
     * @access public
     */
    public $components = array('Session');

    /**
     * Parameter data from Controller::$params
     *
     * @var array
     * @access public
     */
    public $params = array();

    /**
     * Controller requesting notification
     *
     * @var Controller
     * @access public
     */
    private $_requester = null;

    /**
     * Model
     *
     * @var Controller
     * @access public
     */
    private $_model = null;

    /**
     * startup
     * called after Controller::beforeFilter()
     * 
     * @param object $controller instance of controller
     * @return void
     * @access public
     */
    public function startup(Controller $controller) {
        $this->_requester = $controller;
        $this->_model = new Notification();
        return;
    }

    /**
     * getNotifications
     * get notifications for notified
     * 
     * @access public
     * @return boolean
     * 
     */
    public function getNotifications($notified_id = null) {
        if ($notified_id == null) {
            return;
        }
        $this->_model->recursive=1;
        return $this->_model->find('all', array('conditions' => array('notified_id' => $notified_id)));
    }

    /**
     * count unread notifications
     * 
     * @access public
     * @return boolean
     * 
     */
    public function countNotifications($notified_id = null) {
        if ($notified_id == null) {
            return;
        }
        return $this->_model->find('count', array('conditions' => array('notified_id' => $notified_id, 'read' => '0')));
    }

    /**
     * addNotification
     * add notification
     * 
     * @access public
     * @return boolean
     * 
     */
    public function addNotification($notification, $email = null) {
        if (!Configure::read('Tickets.notify')) {
            return true;
        }
        if (!empty($notification)) {
            $this->_model->create();
            if ($this->_model->save($notification)) {
                if (!empty($email)) {
                    $this->_model->recursive=1;
                    $this->_emailNotify($this->_model->read(), $email);
                }
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * changeStatus
     * change notification status ( unread , read )
     * 
     * @access public
     * @return boolean
     * 
     */
    public function changeStatus($id = null, $status = 0) {
        $this->_model->read(null, $id);
        $this->_model->set('status', $status);
        $this->_model->save();
    }

    public function setAllNotificationsReadForNotified($id) {
        $this->_model->UpdateAll(array('read' => true), array('notified_id' => $id));

        return;
    }

    /**
     * delete
     * delete notification
     * 
     * @access public
     * @return boolean
     * 
     */
    public function delete($id, $notified_id) {
        if (!$id || !$notified_id) {
            //$this->Flash->error(__('Invalid request.'));
            return;
        }
        if ($this->_model->deleteAll(array($this->_model->name . '.id' => $id, $this->_model->name . '.notified_id' => $notified_id), false)) {
            //$this->Flash->info(__('Deleted with success.'));
            return;
        }
        //$this->Flash->error(__( 'Could not be deleted.'));
        return;
    }

    /**
     * _emailNotify
     * Send notification by email
     *
     * @return void
     * @access protected
     */
    protected function _emailNotify($notification, $email) {
        if (!Configure::read('Tickets.email_notify')) {
            return true;
        }
        $Email = new CakeEmail('default');
        $Email->template('Phkapa.notification','Phkapa.phkapa')->emailFormat('html');
        $Email->viewVars(array('notification' => $notification,'email'=>$email));
        // uncoment these lines to get more control over sender from and subject!!
        //$Email->sender('noreply@phkapa.net', 'pHKapa');
        //$Email->from(array('noreply@phkapa.net' => 'pHKapa'));
        //$Email->subject(__('pHKapa').' '.__n('Notification', 'Notifications', 1));
        
        $Email->to($email);
        $Email->send();
        return;
    }

}

?>