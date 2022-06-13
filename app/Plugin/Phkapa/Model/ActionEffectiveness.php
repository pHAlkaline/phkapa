<?php
/**
 * Action Effectiveness
 *
 * PHP version 5
 * 
 * @category Model
 * @package  pHKapa
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.net>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */
class ActionEffectiveness extends PhkapaAppModel {

    /**
     * Model name
     *
     * @var string
     * @access public
     */
    public $name = 'ActionEffectiveness';

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
    public $order = 'ActionEffectiveness.id DESC';

    /**
     * Model associations: hasMany
     *
     * @var array
     * @access public
     */
    /*
    public $hasMany = array(
        'Action' => array(
            'className' => 'Phkapa.Action',
            'foreignKey' => 'action_effectiveness_id',
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
        'ActionRevision' => array(
            'className' => 'Phkapa.ActionRevision',
            'foreignKey' => 'action_effectiveness_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
*/
    /**
     * afterFind callback
     * translates model name field
     *
     * @param array $results
     * @param boolean $primary
     * @access public
     * @return array
     */
    public function afterFind($results, $primary = false) {
        if (isset($results[0]['ActionEffectiveness'])) {
            foreach ($results as $key => $val) {
                if (isset($val['ActionEffectiveness']['name'])) {
                    $results[$key]['ActionEffectiveness']['name'] = __d('phkapa', $results[$key]['ActionEffectiveness']['name']);
                }
            }
        }
        if (isset($results['name'])){
            $results['name'] = __d('phkapa', $results['name']);
        }

        return $results;
    }

}

?>