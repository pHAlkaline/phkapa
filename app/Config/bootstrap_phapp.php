<?php

/**
 * Default app settings
 */
Configure::write('Config.language', 'eng'); // por - Portuguese , eng - english
Configure::write('Config.timezone', 'Europe/Lisbon'); // Europe/Lisbon
Configure::write('dateFormat', 'd-m-Y H:i:s');
Configure::write('dateFormatSimple', 'd-m-Y');

/**
 * The settings for maintenance component 
 */
Configure::write('maintenance.start', '10-04-2013 19:20');
Configure::write('maintenance.duration', '2'); // Duration in hours
Configure::write('maintenance.site_offline_url', '/pages/offline');

/**
 * The settings below can be used to open access to all users or one specified user.
 * - 'All' -> after login , all users have total control
 * - '{User NAME field}' -> after login this user has total control 
 */
Configure::write('access.open', ''); // Keep this clean , use only on emergency.



