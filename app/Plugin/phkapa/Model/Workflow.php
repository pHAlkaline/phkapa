<?php
/**
 * Workflow
 *
 * PHP version 5
 * 
 * @category Model
 * @package  PHKAPA
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.phalkaline.eu
 */
class Workflow extends PhkapaAppModel {

   /**
     * Model name
     *
     * @var string
     * @access public
     */
    public $name = 'Workflow';

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
     * afterFind callback
     * translates model name field
     *
     * @param array $results
     * @param boolean $primary
     * @access public
     * @return array
     */
    public function afterFind($results, $primary = false) {
        if (isset($results[0]['Workflow'])) {
            foreach ($results as $key => $val) {
                if (isset($val['Workflow']['name'])) {
                    $results[$key]['Workflow']['name'] = __d('phkapa', $results[$key]['Workflow']['name']);
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