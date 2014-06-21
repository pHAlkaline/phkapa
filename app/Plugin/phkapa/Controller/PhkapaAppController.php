<?php

/**
 * PHKAPA App Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  PHKAPA
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */
class PhkapaAppController extends AppController {

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
            $this->set('title_for_layout', __d('phkapa', 'PHKAPA') . ' - ' . __d('phkapa', 'Administration'));
            $this->set('admin_root', 'phkapa');
        } else {
            $this->set('title_for_layout', __d('phkapa', 'PHKAPA'));
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
        } else {
            $menuItems = array('Query', 'Register', 'Review', 'Plan', 'Verify');
            $user = $this->Auth->user('name');
            /* foreach ($menuItems as $key => $value):
              if (!$this->checkAccess($value, $user)) {
              unset($menuItems[$key]);
              }
              endforeach; */
        }

        $this->set(compact('menuItems'));
    }

    /**
     * Add notification 
     * 
     * @param string $ticket_id 
     * @return void
     * @access protected
     */
    protected function _addNotification($ticket_id = null, $notificationText = null) {
        $ticket = $this->Ticket->find('first', array('recursive'=>'1','order'=>array('Ticket.id'),'conditions' => array('Ticket.id' => $ticket_id)));
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

        $processUsers = $this->Ticket->Process->find('all', array('conditions' => $conditions));
        $reference = Router::url(array('controller' => 'query', 'action' => 'view', $ticket_id,'base'=>false));
        foreach ($processUsers[0]['User'] as $User):
            //debug($User);
            $notifyData = array('notifier_id' => AuthComponent::user('id'), 'notified_id' => $User['id'], 'reference' => $reference, 'notification' => $notificationText,'read'=>0);
            $this->Notify->addNotification($notifyData,$User['email']);
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
        //$user = $this->Auth->user('User');
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