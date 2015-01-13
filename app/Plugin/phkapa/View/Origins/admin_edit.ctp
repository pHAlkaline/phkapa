<h2 class="grid_16" id="page-heading"><?php echo __d('phkapa','Edit %s', __d('phkapa','Origin')); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">	

        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa','Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">			
            <h5><?php echo __dn('phkapa','Origin','Origins',2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa','Delete'), array('action' => 'delete', $this->Form->value('Origin.id')), array('confirm'=> __d('phkapa','Are you sure you want to delete # %s?', $this->Form->value('Origin.id')))); ?></li>
                <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Origin','Origins',2)), array('action' => 'index')); ?></li>
            </ul>

            <h5><?php echo __dn('phkapa','Ticket','Tickets',2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Ticket','Tickets',2)), array('controller' => 'tickets', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Ticket')), array('controller' => 'tickets', 'action' => 'add')); ?> </li>
            </ul>
        </div>

    </div>
    <div class="origins form">
        <?php echo $this->Form->create('Origin'); ?>
        <fieldset class="ui-corner-all ui-widget-content" >
            <legend><?php echo __d('phkapa','Record'). ' ' . __d('phkapa','Origin'); ?></legend>
            <?php
            echo $this->Form->input('id');
            echo $this->Form->input('name',array('label' => __d('phkapa','Name')));
            echo $this->Form->input('active',array('label' => __d('phkapa','Active')));
            ?>
        </fieldset>
        <?php echo $this->Form->end(__d('phkapa','Submit')); ?>
    </div>

</div>
<div class="clear"></div>
