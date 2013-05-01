<h2 class="grid_16" id="page-heading"><?php echo __('Add %s', __('User')); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">	
        		
            <h2>
                <a href="#" id="toggle-admin-actions"><?php echo __('Menu'); ?></a>
            </h2>
            <div class="block" id="admin-actions">			
                <h5><?php echo __n('User','Users',2); ?></h5>
                <ul class="menu">
                    <li><?php echo $this->Html->link(__('List %s', __n('User','Users',2)), array('action' => 'index')); ?></li>
               
            </div>
      
    </div>
    <div class="users form">
        <?php echo $this->Form->create('User'); ?>
        <fieldset class="ui-corner-all ui-widget-content" >
            <legend><?php echo __('Record').' '. __('User'); ?></legend>
            <?php
            echo $this->Form->input('name',array('label' => __('Name')));
            echo $this->Form->input('email',array('maxlength'=>'256','label' => __('Email')));
            echo '<br/>';
            echo $this->Form->input('username',array('maxlength'=>'8','label' => __('Username')));
            echo $this->Form->input('password',array('maxlength'=>'8','label' => __('Password')));
            echo $this->Form->input('active',array('label' => __('Active')));
            
            ?>
        </fieldset>
        <?php echo $this->Form->end(__('Submit')); ?>
    </div>

</div>
<div class="clear"></div>
