<?php
$this->html->script('user_edit', false);
?>
<h2 class="grid_16" id="page-heading"><?php echo __('Edit %s', __('User')); ?></h2>
<div class="grid_16 actionsContainer">
  
    <div class="users form">
        <?php echo $this->Form->create('User'); ?>
        <fieldset class="ui-corner-all ui-widget-content" >
            <legend><?php echo __('Record').' '. __('User'); ?></legend>
            <?php
            echo $this->Form->input('id');
            echo $this->Form->input('name',array('maxlength'=>'64','label' => __('Name')));
            echo $this->Form->input('email',array('maxlength'=>'256','label' => __('Email')));
            echo '<br/>';
            
            echo $this->Form->input('username',array('maxlength'=>'40','label' => __('Username')));
            echo "<hr/>";
            echo $this->Form->input('edpassword', array('label' => __('Enable change password'),'type'=>'checkbox'));
            echo $this->Form->input('password',array('maxlength'=>'40','label' => __('Password'),'disabled'=>'disabled'));
            
           
            ?>
        </fieldset>
        <?php echo $this->Form->end(__('Submit')); ?>
    </div>

</div>
<div class="clear"></div>
