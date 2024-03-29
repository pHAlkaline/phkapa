<?php
$this->Number->defaultCurrency(Configure::read('currency'));
?>
<?php

/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1"></meta>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>

<?php if (Configure::read('debug') == 0) { ?>
        <meta http-equiv="Refresh" content="<?php echo $pause?>;url=<?php echo $url?>"/>
<?php } ?>
        <style><!--
            P { text-align:center; font:bold 1.1em sans-serif }
            A { color:#444; text-decoration:none }
            A:HOVER { text-decoration: underline; color:#44E }
            --></style>
    </head>
    <body>
        <p><a href="<?php echo $url?>"><?php echo $message?></a></p>
    </body>
</html>