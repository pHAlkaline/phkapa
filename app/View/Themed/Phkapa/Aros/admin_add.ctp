<?php
$this->html->script('aro_add_edit', false);
?>

<h2 class="grid_16" id="page-heading"><?php echo __('Add %s', __('Aro')); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">	
        			
            <h2>
                <a href="#" id="toggle-admin-actions"><?php echo __('Menu'); ?></a>
            </h2>
            <div class="block" id="admin-actions">			
                <h5><?php echo __n('Aro','Aros',2); ?></h5>
                <ul class="menu">
                    <li><?php echo $this->Html->link(__('List %s', __n('Aro','Aros',2)), array('action' => 'index')); ?></li>
                </ul>


            </div>
      
    </div>



    <div class="origins form">
        <?php echo $this->Form->create('Aro'); ?>
        <fieldset class="ui-corner-all ui-widget-content">
            <legend><?php echo __('Record'). ' ' . __('Aro'); ?></legend>
            <?php
            echo $this->Form->input('foreign_key', array('options'=>$foreignKeys, 'label' => __('User'), 'empty' => __('Type Group')));
            echo $this->Form->input('alias', array('label' => __('Name')));
            echo $this->Form->input('parent_id',array('label' => __('Parent node')));
            
            ?>
        </fieldset>
        <?php echo $this->Form->end(__('Submit')); ?>
    </div>

</div>
<div class="clear"></div>