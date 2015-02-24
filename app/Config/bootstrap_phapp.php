<?php

/**
 * app Plugins
 */


/**
 * Languages available
 */
Configure::write('Config.language', 'eng'); 
Configure::write('Language.list',array(
    'eng'=>'English',
    'deu'=>'Deutsch',
    'por'=>'Português',
    'pt_BR'=>'Portugues ( Brasil )',
    'spa'=>'Español'
    )); 

/**
 * Datetime Settings
 */
Configure::write('Config.timezone', 'Europe/London'); // Europe/Lisbon
Configure::write('dateFormat', 'd-m-Y H:i:s'); // Date Format with time
Configure::write('dateFormatSimple', 'd-m-Y'); // Date Format without time
Configure::write('Application.mode', 'phkapa'); // phkapa , demo , use demo for demo mode;

/**
 * Settings for maintenance component 
 */
Configure::write('Maintenance.start', '31-07-2014 00:00'); 
Configure::write('Maintenance.duration', '2'); // Duration in hours
Configure::write('Maintenance.site_offline_url', '/pages/offline');
Configure::write('Maintenance.offline_destroy_session', false); // true or false , with true - Offline will destroy user sessions

/**
* Settings for revision / history behavior
* By default available for Ticket and Action tables
*/
Configure::write('Revision.tables', array()); // Use Ticket , Action or Both => array('Ticket','Action')

/**
 * The settings below can be used to open access to all users or one specified user.
 * - 'All' -> after login , all users have TOTAL access
 * - '{User NAME field}' -> after login this user has total control 
 */
Configure::write('Access.open', ''); // Keep this clean , use only on emergency.
