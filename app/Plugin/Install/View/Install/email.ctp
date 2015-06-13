<h2 class="grid_16" id="page-heading"><?php echo $title_for_step; ?></h2>
<div class="grid_16 actionsContainer">
    


    <div class="database form">
        <?php echo $this->Form->create(false, array('url' => array('controller' => 'install', 'action' => 'email')));
		 ?>
        <fieldset class="ui-corner-all ui-widget-content" >
            <legend><?php echo __('Setup notification email'); ?></legend>
            <?php
                echo $this->Form->input('email', array('label' => __('From Email'), 'default' => 'no-reply@yourhost.net'));
		echo $this->Form->input('name', array('label' => __('From Name'), 'default' => 'Your Site PHKAPA Notification'));
		echo $this->Form->input('subject', array('label' => __('Subject'), 'default' => 'New PHKAPA Notification!!'));
            ?>
        </fieldset>
        <?php echo $this->Form->end(__('Submit')); ?>
    </div>

</div>
<div class="clear"></div>