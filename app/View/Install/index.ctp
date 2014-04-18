<h2 class="grid_16" id="page-heading"><?php echo $title_for_step; ?></h2>
<div class="grid_16 actionsContainer">
    
    <div class="install index">
        <?php
        $check = true;

        // tmp is writable
        if (is_writable(TMP)) {
            $message = __('Your tmp directory is writable.');
            echoMessage($message);
        } else {
            $check = false;
            $message = __('Your tmp directory is NOT writable.') . ' --> ' . TMP;
            echoError($message);
        }

        // config is writable
        if (is_writable(APP . 'Config')) {
            $message = __('Your Config directory is writable.');
            echoMessage($message);
        } else {
            $check = false;
            $message = __('Your Config directory is NOT writable.') . ' --> ' . APP . 'Config';
            echoError($message);
        }

        // php version
        if (version_compare(phpversion(), 5.2, '>=')) {
            $message = sprintf(__('PHP version %s > 5.2'), phpversion());
            echoMessage($message);
        } else {
            $check = false;
            $message = sprintf(__('PHP version %s < 5.2'), phpversion());
            echoError($message);
        }

        // php version
        $minCakeVersion = '2.4.7';
        $cakeVersion = Configure::version();
        if (version_compare($cakeVersion, $minCakeVersion, '>=')) {
            $message = __('CakePhp version %s >= %s', $cakeVersion, $minCakeVersion);
            echoMessage($message);
        } else {
            $check = false;
            $message = __('CakePHP version %s < %s', $cakeVersion, $minCakeVersion);
            echoError($message);
        }

        if ($check) {
            $message = $this->Html->link('Click here to begin installation', array('action' => 'database'));
            echoBeginMessage($message);
        } else {
            $message = __('Installation cannot continue as minimum requirements are not found.');
            echoError($message);
        }
        ?>
    </div>
</div>
<?php

function echoBeginMessage($message) {
    ?>
    <div class = "ui-widget">
        <div class = "ui-state-highlight ui-corner-all message" style="border-color:green" >
            <span class = "" style = "float: left; margin: 3px;"></span>
            <?php echo $message;
            ?>
        </div>
    </div>
    <?php
}

function echoMessage($message) {
    ?>
    <div class = "ui-widget">
        <div class = "ui-state-highlight ui-corner-all message"  >
            <span class = "ui-icon ui-icon-info" style = "float: left; margin: 3px;"></span>
            <?php echo $message;
            ?>
        </div>
    </div>
    <?php
}

function echoError($message) {
    ?>
    <div class="ui-widget">
        <div class="ui-state-error ui-corner-all message" > 
            <span class="ui-icon ui-icon-alert" style="float: left; margin: 3px;"></span> 
            <?php echo $message; ?>
        </div>
    </div>
    <?php
}
?>