<h2 class="grid_16" id="page-heading"><?php echo __d('phkapa','Add %s', __d('phkapa','Category')); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">	
       		
            <h2>
                <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa','Menu'); ?></a>
            </h2>
            <div class="block" id="admin-actions">			
                <h5><?php echo __dn('phkapa','Category','Categories',2); ?></h5>
                <ul class="menu">
                    <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Category','Categories',2)), array('action' => 'index')); ?></li>
                </ul>

                <h5><?php echo __dn('phkapa','Ticket','Tickets',2); ?></h5>
                <ul class="menu">
                    <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Ticket','Tickets',2)), array('controller' => 'tickets', 'action' => 'index')); ?> </li>
                    <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Ticket')), array('controller' => 'tickets', 'action' => 'add')); ?> </li>
                </ul>

                <h5><?php echo __dn('phkapa','Process','Processes',2); ?></h5>
                <ul class="menu">
                    <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Process','Processes',2)), array('controller' => 'processes', 'action' => 'index')); ?> </li>
                    <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Process')), array('controller' => 'processes', 'action' => 'add')); ?> </li>
                </ul>
                
                <h5><?php echo __dn('phkapa','Cause','Causes',2); ?></h5>
                <ul class="menu">
                    <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Cause','Causes',2)), array('controller' => 'causes', 'action' => 'index')); ?> </li>
                    <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Cause')), array('controller' => 'causes', 'action' => 'add')); ?> </li>
                </ul>
            </div>
        
    </div>
    <div class="categories form">
        <?php echo $this->Form->create('Category'); ?>
        <fieldset class="ui-corner-all ui-widget-content" >
            <legend><?php echo __d('phkapa','Record').' '.__d('phkapa','Category'); ?></legend>
            <?php
            echo $this->Form->input('name',array('label' => __d('phkapa','Name')));
            echo $this->Form->input('active',array('label' => __d('phkapa','Active')));
            echo $this->Form->input('Process',array('label' => __d('phkapa','Process')));
            echo $this->Form->input('Cause',array('label' => __d('phkapa','Cause')));
            echo $this->Form->submit(__d('phkapa', 'Submit'));
            ?>
        </fieldset>
        <?php echo $this->Form->end(); ?>
    </div>

</div>
<div class="clear"></div>
