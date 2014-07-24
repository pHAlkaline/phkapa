<?php

/**
 * Default app settings
 */
Configure::write('Config.language', 'eng'); // por - Portuguese , eng - english
Configure::write('Language.list',array(
    'eng'=>'English',
    'deu'=>'German',
    'por'=>'Portugues',
    'pt_BR'=>'Portugues ( Brasil)',
    )); // 

Configure::write('Config.timezone', 'Europe/London'); // Europe/Lisbon

Configure::write('dateFormat', 'd-m-Y H:i:s'); //
Configure::write('dateFormatSimple', 'd-m-Y'); //
Configure::write('Application.mode', 'phkapa'); // phkapa , demo , use demo for demo mode;

/**
 * The settings for maintenance component 
 */
Configure::write('Maintenance.start', '10-04-2013 19:20'); 
Configure::write('Maintenance.duration', '2'); // Duration in hours
Configure::write('Maintenance.site_offline_url', '/pages/offline');

/**
 * The settings below can be used to open access to all users or one specified user.
 * - 'All' -> after login , all users have TOTAL access
 * - '{User NAME field}' -> after login this user has total control 
 */
Configure::write('Access.open', ''); // Keep this clean , use only on emergency.
