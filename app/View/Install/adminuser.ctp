

<h2 class="grid_16" id="page-heading"><?php echo $title_for_step; ?></h2>
<div class="grid_16 actionsContainer">
    


    <div class="database form">
        <?php echo $this->Form->create(false, array('url' => array('controller' => 'install', 'action' => 'adminuser')));
		 ?>
        <fieldset class="ui-corner-all ui-widget-content" >
            <legend><?php echo __('Admin user password'); ?></legend>
            <?php
                echo $this->Form->input('User.password', array('maxlength'=>'8','label' => __('New Password'), 'value' => ''));
		echo $this->Form->input('User.verify_password', array('maxlength'=>'8','label' => __('Verify Password'), 'type' => 'password', 'value' => ''));
            ?>
        </fieldset>
        <?php echo $this->Form->end(__('Submit')); ?>
    </div>

</div>
<div class="clear"></div>