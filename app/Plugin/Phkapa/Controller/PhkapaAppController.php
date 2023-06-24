<?php

/**
 * pHKapa App Controller
 *
 * PHP version 7
 *
 * @category Controller
 * @package  pHKapa
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.net>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     https://phalkaline.net
 */
class PhkapaAppController extends AppController {

    /**
     * beforeFilter
     *
     * @return void
     * @access public
     * @throws 
     */
    public function beforeFilter() {
        parent::beforeFilter();
        if (CakePlugin::loaded('Feedback')) {
            $this->Comments = $this->Components->load('Feedback.Comments', array('on' => array('admin_view', 'admin_edit', 'view', 'edit', 'add_action', 'edit_action')));
            if (isset($this->Ticket) && get_class($this->Ticket) == 'Ticket') {
                $this->Ticket->Behaviors->load('Feedback.Commentable');
            }
        }
        if (CakePlugin::loaded('Attachment')) {
            $this->Attachments = $this->Components->load('Attachment.Attachments', array('on' => array('admin_view', 'admin_edit', 'view', 'edit', 'add_action', 'edit_action')));
            if (isset($this->Ticket) && get_class($this->Ticket) == 'Ticket') {
                $this->Ticket->Behaviors->load('Attachment.Attachable');
            }
        }
    }

    /**
     * beforeRender callback
     *
     * @return void
     * @access public
     * @throws
     */
    public function beforeRender() {
        parent::beforeRender();
        $this->_setMenu();

        if (isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') {
            $this->set('title_for_layout', __d('phkapa', 'pHKapa') . ' - ' . __d('phkapa', 'Administration'));
        } else {
            $this->set('title_for_layout', __d('phkapa', 'pHKapa'));
        }
        //$this->set('pluginImage', 'Phkapa.phkapa.png');
    }

    /**
     * set menu with app objects controllers or with $menuItems = array('Query', 'Register', 'Plan', 'Verify');
     *
     * @return void
     * @access protected
     * @throws
     */
    protected function _setMenu() {
        if (isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') {
            $excludedMenuItems = array('PhkapaApp', 'Phkapa', 'Query', 'Verify', 'Review', 'Register', 'Plan');
            $menuItems = App::objects('Phkapa.Controller');
            foreach ($excludedMenuItems as $item) {
                $item.='Controller';
                if (array_search($item, $menuItems) !== '') {
                    unset($menuItems[array_search($item, $menuItems)]);
                }
            }
            foreach ($menuItems as $key => $value) {
                $menuItems[$key] = str_replace('Controller', '', $value);
            }
            sort($menuItems);
            $this->set('user_at_string', __n('User', 'Users', 1) . ' ' . $this->Session->read('Auth.User.name') . ' @ ' . __('pHKapa Setup'));
        } else {
            $menuItems = array('Query', 'Register', 'Review', 'Plan', 'Verify');
            $user = $this->Auth->user('name');
            /* foreach ($menuItems as $key => $value):
              if (!$this->checkAccess($value, $user)) {
              unset($menuItems[$key]);
              }
              endforeach; */
            $this->set('user_at_string', __n('User', 'Users', 1) . ' ' . $this->Session->read('Auth.User.name') . ' @ ' . __('pHKapa'));
        }
        $translationDomain = 'phkapa';
        $this->set(compact('menuItems', 'translationDomain'));
    }

    /**
     * Add notification 
     * 
     * @param string $ticket_id 
     * @return void
     * @access protected
     */
    protected function _addNotification($ticket_id = null, $notificationText = null) {
        $ticket = $this->Ticket->find('first', array('recursive' => '1', 'order' => array('Ticket.id'), 'conditions' => array('Ticket.id' => $ticket_id)));
        $registarId = $ticket['Ticket']['registar_id'];
        $conditions = array("Process.id" => $ticket['Process']['id']);
        $this->Ticket->Process->bindModel(
                array('hasAndBelongsToMany' => array(
                        'User' => array(
                            'className' => 'Phkapa.User',
                            'joinTable' => 'phkapa_processes_users',
                            'foreignKey' => 'process_id',
                            'associationForeignKey' => 'user_id',
                            'unique' => true,
                            'conditions' => array('User.active' => '1', 'User.id <>' => $registarId),
        ))));
        $this->Ticket->Process->recursive = 2;
        $processUsers = $this->Ticket->Process->find('all', array('conditions' => $conditions));
        $reference = Router::url(array('controller' => 'query', 'action' => 'view', $ticket_id, 'base' => false));
        foreach ($processUsers[0]['User'] as $User):
            $notifyData = array('notifier_id' => AuthComponent::user('id'), 'notified_id' => $User['id'], 'reference' => $reference, 'notification' => $notificationText, 'read' => 0);
            $this->Notify->addNotification($notifyData, $User['email']);
        endforeach;
        return;
    }

    /**
     * isAuthorized
     *
     * @param  user data array
     * @return boolean
     * @access public
     * @throws 
     */
    public function isAuthorized($user = null) {
        $result = false;
        if (isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') {
            return $this->Acl->check($user['name'], 'Phkapa/Administration');
        }
        $result = $this->checkAccess($this->request->params['controller'], $user['name']);
        return $result;
    }

    /**
     * checkAccess
     *
     * @param  string request
     * @param  array user data 
     * @return boolean
     * @access public
     * @throws 
     */
    public function checkAccess($request = null, $user = null) {

        $result = $this->Acl->Aro->findByAlias($user);
        if (!isset($result['Aro']))
            return false;

        $result = false;

        switch (ucfirst($request)) {
            case 'Register':
                $result = $this->Acl->check($user, 'Phkapa/Register');
                break;
            case 'Review':
                $result = $this->Acl->check($user, 'Phkapa/Review');
                break;
            case 'Plan':
                $result = $this->Acl->check($user, 'Phkapa/Plan');
                break;
            case 'Verify':
                $result = $this->Acl->check($user, 'Phkapa/Verify');
                break;
            case 'Query':
                $result = $this->Acl->check($user, 'Phkapa/Query');
                break;
            case 'Phkapa':
                $result = $result || $this->Acl->check($user, 'Phkapa');
                $result = $result || $this->Acl->check($user, 'Phkapa/Register');
                $result = $result || $this->Acl->check($user, 'Phkapa/Review');
                $result = $result || $this->Acl->check($user, 'Phkapa/Plan');
                $result = $result || $this->Acl->check($user, 'Phkapa/Verify');
                $result = $result || $this->Acl->check($user, 'Phkapa/Query');

                break;
        }
        return $result;
    }

}

?>