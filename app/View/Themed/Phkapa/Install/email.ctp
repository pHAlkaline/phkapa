<h2 class="grid_16" id="page-heading"><?php echo $title_for_step; ?></h2>
<div class="grid_16 actionsContainer">



    <div class="database form">
        <?php echo $this->Form->create(false, array('url' => array('controller' => 'install', 'action' => 'email')));
        ?>
        <fieldset class="ui-corner-all ui-widget-content" >
            <legend><?php echo __d('install', 'Setup notification email'); ?></legend>
            <?php
            echo $this->Form->input('email', array('label' => __d('install', 'From Email'), 'default' => 'no-reply@yourhost.net'));
            echo $this->Form->input('name', array('label' => __d('install', 'From Name'), 'default' => 'Your Site pHKapa Notification'));
            echo $this->Form->input('subject', array('label' => __d('install', 'Subject'), 'default' => 'New pHKapa Notification!!'));
            echo $this->Form->submit(__('Submit'));
            ?>
        </fieldset>
        <?php echo $this->Form->end(); ?>

    </div>
    <div class="clear"></div>