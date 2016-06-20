<?php

/**
 * Access Plugin model
 *
 * User
 *
 * PHP version 5
 * 
 * @category Models
 * @package  pHKapa
 * @version  V1.4
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */
App::uses('AuthComponent', 'Controller/Component');

class User extends AccessAppModel {

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
     * Table prefix for model table
     *
     * @var string
     * @access public
     */
    public $tablePrefix = null;
    
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

    
    /*
    public $hasMany = array(
        'RegistredTicket' => array(
            'className' => 'Phkapa.Ticket',
            'foreignKey' => 'registar_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'CloseTicket' => array(
            'className' => 'Phkapa.Ticket',
            'foreignKey' => 'close_user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'ModifiedTicket' => array(
            'className' => 'Phkapa.Ticket',
            'foreignKey' => 'modified_user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'ModifiedTicketRevision' => array(
            'className' => 'Phkapa.TicketRevision',
            'foreignKey' => 'modified_user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'VerifyAction' => array(
            'className' => 'Phkapa.Action',
            'foreignKey' => 'verify_user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'CloseAction' => array(
            'className' => 'Phkapa.Action',
            'foreignKey' => 'close_user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'ModifiedAction' => array(
            'className' => 'Phkapa.Action',
            'foreignKey' => 'modified_user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'ModifiedActionRevision' => array(
            'className' => 'Phkapa.ActionRevision',
            'foreignKey' => 'modified_user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
    );
*/
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
                'message' => __d('access', 'This name is restricted by system.')
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
            $this->data[$this->alias]['password'] = AuthComponent::password(substr($this->data[$this->alias]['password'], 0, 40));
        }

        // truncate username
        if (isset($this->data[$this->alias]['username'])) {
            $this->data[$this->alias]['username'] = substr($this->data[$this->alias]['username'], 0, 40);
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
        return parent::beforeDelete($cascade);
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
    public function afterSave($created, $options = array()) {
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