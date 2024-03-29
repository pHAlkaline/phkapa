<?php

/**
 * AccessApp App Controller
 *
 * PHP version 7
 *
 * @category Controller
 * @package  pHKapa
 * @version  V1.4
 * @author   Paulo Homem <contact@phalkaline.net>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     https://phalkaline.net
 */
class AccessAppController extends AppController {

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
        //$this->set('pluginImage', 'Phkapa.phkapa.png');
    }

    /**
     * set menu items
     *
     * @return void
     * @access protected
     * @throws
     */
    protected function _setMenu() {
        $menuItems = array( 'Aros', 'AccessUsers');
        $translationDomain='access';
        $this->set(compact('menuItems','translationDomain'));
        $this->set('title_for_layout', __d('access','Access Setup'));
        $this->set('user_at_string', __n('User','Users',1) . ' ' . $this->Session->read('Auth.User.name') . ' @ ' . __d('access', 'Access Setup'));
    }

    /**
     * isAuthorized
     *
     * @param  array user data
     * @return boolean
     * @access public
     * @throws 
     */
    public function isAuthorized($user = null) {
        if (Configure::read('Access.open') == 'All' || Configure::read('Access.open') == $user['name']) {
            return true;
        }
        return $this->Acl->check($user['name'], 'Total');
    }

}

?>