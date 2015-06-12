<?php

App::uses('BaseAuthenticate', 'Controller/Component/Auth');

/**
 * PHKAPA Component
 *
 * PHP version 5
 *
 * @category Component
 * @package  PHKAPA.app.Controller.Component.Auth
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */
class SimpleAuthenticate extends BaseAuthenticate {

    /**
     * Authenticate a user based on the request information.  Will use the configured User model and attempt a login.
     *
     * @param CakeRequest $request Request to get authentication information from.
     * @param CakeResponse $response A response object that can have headers added.
     * @return mixed Either false on failure, or an array of user data on success.
     * @access public	
     */
    public function authenticate(CakeRequest $request, CakeResponse $response) {
        $userModel = $this->settings['userModel'];
        list($plugin, $model) = pluginSplit($userModel);

        $fields = $this->settings['fields'];
        if (empty($request->data[$model])) {
            return false;
        }
        if (
                empty($request->data[$model][$fields['username']]) ||
                empty($request->data[$model][$fields['password']])
        ) {
            return false;
        }

        return $this->_findUser(
                        $request->data[$model][$fields['username']], $request->data[$model][$fields['password']]
        );
    }

    /**
     * _findUser
     *
     * @return mixed Either false on failure, or an array of user data on success.
     * @access protected
     */
    protected function _findUser($username, $password) {
        $userModel = $this->settings['userModel'];
        list($plugin, $model) = pluginSplit($userModel);
        $fields = $this->settings['fields'];

        $conditions = array(
            $model . '.' . $fields['username'] => $username,
            $model . '.' . $fields['password'] => $password,
        );
        if (!empty($this->settings['scope'])) {
            $conditions = array_merge($conditions, $this->settings['scope']);
        }
        $result = ClassRegistry::init($userModel)->find('first', array(
            'conditions' => $conditions,
            'recursive' => (int) $this->settings['recursive']
                ));
        if (empty($result) || empty($result[$model])) {
            return false;
        }
        unset($result[$model][$fields['password']]);
        return $result[$model];
    }

}

?>
