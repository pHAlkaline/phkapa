<?php
/**
 * pHKapa routes file
 *
 * PHP 5
 *
 * @category Controller
 * @package  PHKAPA.app.Config
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */

/*if (file_exists(TMP.'installed.txt')) {
    // the routes for when the application has been installed
    //echo "installed";
} else {
    //echo "install";
    Router::connect('/:controler/:action', array('controller' => 'install'));
}*/
Router::parseExtensions('pdf');
Router::parseExtensions('csv');
 