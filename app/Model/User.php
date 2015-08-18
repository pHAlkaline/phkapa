<?php

/**
 * User
 *
 * PHP version 5
 *
 * @category Model
 * @package  PHKAPA
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

    /**
     * Model name
     *
     * @var string
     * @access public
     */
    public $name = 'User';

    /**
     * Display Fields for this model
     *
     * @var mixed string or array
     * @access public
     */
    public $displayField = 'name';

    /**
     * Order
     *
     * @var mixed  string or array
     * @access public
     */
    public $order = 'name ASC';

    /**
     * Validation
     *
     * @var array
     * @access public
     */
    public $validate = array(
        'name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'Must be unique',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'username' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'Must be unique',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'password' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Empty',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'verify_password' => array(
            'matchPasswords' => array(
                'rule' => array('matchPasswords'),
                'message' => 'Passwords dont match',
                'required' => false),

        ),
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Invalid email',
                'required' => false,
                'allowEmpty' => true),
             'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'Must be unique',
                ),
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations

        ),
    );

    function matchPasswords($data) {

        if ($data['verify_password'] == $this->data['User']['password']) {
            return true;
        }
        return false;
    }

    /**
     * beforeSave callback
     * Check if user name is unique and allowed in aro
     * Encrypt password
     *
     * @param array model options
     * @access public
     * @return boolean
     */
    public function beforeSave($options = array()) {


        App::uses('Aro', 'Model');
        $this->Aro = new Aro();
        // alias = user name ,  must be unique
        $this->Aro->validate = array(
            'alias' => array(
                'rule' => 'isUnique',
                'message' => __('This name is restricted by system.')
                ));

        $aro = $this->Aro->findByForeignKey($this->id);
        if ($aro) {
            $aro['Aro']['alias'] = $this->data['User']['name'];
            $aro = $aro['Aro'];
            $this->Aro->set($aro);
        }

        if ($aro && !$this->Aro->validates($aro)) {
            $errors = $this->Aro->validationErrors;
            $this->data = null;
            return false;
        }

        // crypt and truncate password
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password(substr($this->data[$this->alias]['password'],0,40));
        }

        // truncate username
        if (isset($this->data[$this->alias]['username'])) {
            $this->data[$this->alias]['username'] = substr($this->data[$this->alias]['username'],0,40);
        }

        return true;
    }

    /**
     * beforeDelete callback
     *
     * @param boolean $cascade
     * @access public
     * @return boolean
     */
    public function beforeDelete($cascade = true) {
        // protects administrator to be deleted
        if ($this->id == 1)
            return false;
        return true;
    }

    /**
     * afterSave callback
     * updates Aro->alias with user name
     *
     * @param boolean $created
     * @param array $options
     * @access public
     * @return boolean
     */
    public function afterSave($created, $options=array()) {
        App::uses('Aro', 'Model');
        $this->Aro = new Aro();
        $aro = $this->Aro->findByForeignKey($this->id);
        if ($aro) {
            $aro['Aro']['alias'] = $this->data['User']['name'];
            $aro = $aro['Aro'];
            $this->Aro->set($aro);
        }
        $this->Aro->save($aro);

        return true;
    }

}

?>