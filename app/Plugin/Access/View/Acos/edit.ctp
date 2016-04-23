<h2 class="grid_16" id="page-heading"><?php echo __('Edit %s', __dn('access','Aco','Acos',1)); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">	
       			
            <h2>
                <a href="#" id="toggle-admin-actions"><?php echo __('Menu'); ?></a>
            </h2>
            <div class="block" id="admin-actions">			
                <h5><?php echo __dn('access','Aco','Acos',1); ?></h5>
                <ul class="menu">
                    <li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('Aco.id')), array('confirm'=> __('Are you sure you want to delete # %s?', $this->Form->value('Aco.alias')) .'. '.__('This will also delete childs!!'))); ?></li>
                    <li><?php echo $this->Html->link(__('List %s', __dn('access','Aco','Acos',2)), array('action' => 'index')); ?></li>
                </ul>


            </div>
       
    </div>



    <div class="origins form">
        <?php echo $this->Form->create('Aco'); ?>
        <fieldset class="ui-corner-all ui-widget-content" >
            <legend><?php echo __('Record'), __dn('access','Aco','Acos',1); ?></legend>
            <?php
            echo $this->Form->input('id');
            echo $this->Form->input('alias', array('label' => __('Name')));
            echo $this->Form->input('parent_id',array('label' => __('Parent node')));
            echo $this->Form->submit(__('Submit'));
            ?>
        </fieldset>
        <?php echo $this->Form->end(); ?>
    </div>

</div>
<div class="clear"></div>
