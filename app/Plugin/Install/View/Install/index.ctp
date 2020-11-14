<h2 class="grid_16" id="page-heading"><?php echo $title_for_step; ?></h2>
<div class="grid_16 actionsContainer">
     <?php echo $this->Form->create('Install', array('id' => 'languageFrm')); ?>

    <fieldset class="ui-corner-all ui-widget-content" >
        <legend><?php echo __d('install','Language'); ?></legend>
       <?php
       echo $this->Form->input('language', array('options' => Configure::read('Language.list'), 'empty' => '(choose one)','onchange'=>'this.form.submit();'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(); ?>
    <div class="install index">
        <?php
        $check = true;

        // tmp is writable
        if (is_writable(TMP)) {
            $message = __d('install','Your tmp directory is writable.');
            echoMessage($message);
        } else {
            $check = false;
            $message = __d('install','Your tmp directory is NOT writable.') . ' --> ' . TMP;
            echoError($message);
        }

        // config is writable
        if (is_writable(APP . 'Config')) {
            $message = __d('install','Your Config directory is writable.');
            echoMessage($message);
        } else {
            $check = false;
            $message = __d('install','Your Config directory is NOT writable.') . ' --> ' . APP . 'Config';
            echoError($message);
        }
        
        // config/core.php is writable
        if (is_writable(APP . 'Config'. DS .'core.php')) {
            $message = __d('install','Your Config/core.php file is writable.');
            echoMessage($message);
        } else {
            $check = false;
            $message = __d('install','Your Config/core.php file is NOT writable.') . ' --> ' . APP . 'Config' . DS . 'core.php';
            echoError($message);
        }

        // php version
        if (version_compare(phpversion(), 5.6, '>=')) {
            $message = sprintf(__d('install','PHP version %s >= 5.6'), phpversion());
            echoMessage($message);
        } else {
            $check = false;
            $message = sprintf(__d('install','PHP version %s < 5.6'), phpversion());
            echoError($message);
        }

        // php version
        $minCakeVersion = '2.10.22';
        $cakeVersion = Configure::version();
        if (version_compare($cakeVersion, $minCakeVersion, '>=')) {
            $message = __d('install','CakePhp version %s >= %s', $cakeVersion, $minCakeVersion);
            echoMessage($message);
        } else {
            $check = false;
            $message = __d('install','CakePHP version %s < %s', $cakeVersion, $minCakeVersion);
            echoError($message);
        }

        if ($check) {
            $message = $this->Html->link(__d('install','Click here to begin installation'), array('action' => 'database'));
            echoBeginMessage($message);
        } else {
            $message = __d('install','Installation cannot continue as minimum requirements are not found.');
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