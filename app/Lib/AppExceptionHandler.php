<?php

/**
 *
 * pHKapa : pHKapa software for condominium property managers (http://phalkaline.net)
 * Copyright (c) pHAlkaline . (http://phalkaline.net)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 *
 * @copyright     Copyright (c) pHAlkaline . (http://phalkaline.net)
 * @link          https://phkapa.net pHKapa Project
 * @package       app.Lib
 * @since         pHKapa v 1.7
 * @license      http://www.opensource.org/licenses/mit-license.php The MIT License
 * 
 */

class AppExceptionHandler extends ErrorHandler{
    public static function handleException($error) {
        if(get_class($error) == 'MissingControllerException') {
           Configure::write('Exception.skipLog', array('MissingControllerException'));
        }
        parent::handleException($error);
    }
} 
