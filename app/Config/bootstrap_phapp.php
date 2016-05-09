<?php
/**
 * pHKapa bootstrap file
 *
 * PHP 5
 *
 * @category Controller
 * @package  app.Config
 * @version  V1
 * @author   Paulo Homem <contact@phalkaline.eu>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://phkapa.net
 */
/**
 * app Plugins
 */
CakePlugin::load('DebugKit');
CakePlugin::load('PrintReport', array('bootstrap' => true, 'routes' => false));
CakePlugin::load('CsvView', array('bootstrap' => true, 'routes' => false));
CakePlugin::load('Install', array('bootstrap' => false, 'routes' => false));
CakePlugin::load('Attachment',array('bootstrap'=>true));
CakePlugin::load('Feedback',array('bootstrap'=>true));
/**
 * Languages available
 */
Configure::write('Config.language', 'eng'); 
Configure::write('Language.list',array(
    'deu'=>'Deutsch',
    'eng'=>'English',
    'por'=>'Português',
    'pt_BR'=>'Portugues ( Brasil )',
    'ron' =>'Român',
    'spa'=>'Español'
    )); 
/**
 * Datetime Settings
 */
Configure::write('Config.timezone', 'Europe/London'); // Europe/Lisbon
Configure::write('dateFormat', 'd-m-Y H:i:s'); // Date Format with time
Configure::write('dateFormatSimple', 'd-m-Y'); // Date Format without time
/**
 * Other Settings
 */
Configure::write('Application.mode', 'phkapa'); // options ( phkapa or demo )  , use demo for demo mode;
Configure::write('Application.logo_image', 'yourlogo.png'); // upload image to app/webroot/img or app/View/Themed/{your_theme}/webroot/img
Configure::write('Application.theme', 'Phkapa'); // activate theme - app/View/Themed
/**
 * Settings for maintenance component 
 */
Configure::write('Maintenance.start', '21-08-2015 23:59'); 
Configure::write('Maintenance.duration', '3'); // Duration in hours
Configure::write('Maintenance.site_offline_url', '/pages/offline');
Configure::write('Maintenance.offline_destroy_session', false); // true or false , with true - Offline will destroy user sessions
/**
* Settings for revision / history behavior
* By default deactivated
* To activate include values in array()
*/
Configure::write('Revision.tables', array('Ticket','Action')); // Set Ticket or Action or Both => array('Ticket','Action')
/**
 * The settings below can be used to open access to all users or one specified user.
 * - 'All' -> after login , all users have TOTAL access
 * - '{User NAME field}' -> after login this user has total control 
 */
Configure::write('Access.open', ''); // Keep this clean , use only on emergency, is case you forgot your access to phKapa
/**
 * Settings for notification component 
 */
Configure::write('Tickets.notify', true); // true to use notifications
Configure::write('Tickets.email_notify', false); // true to send email notification , Tickets.notify will override this one.

