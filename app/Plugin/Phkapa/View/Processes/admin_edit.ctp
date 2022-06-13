<h2 class="grid_16" id="page-heading"><?php echo __d('phkapa','Edit %s', __d('phkapa','Process')); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">	

        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa','Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">			
            <h5><?php echo __dn('phkapa','Process','Processes',2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa','Delete'), array('action' => 'delete', $this->Form->value('Process.id')), array('confirm'=> __d('phkapa','Are you sure you want to delete # %s?', $this->Form->value('Process.name')))); ?></li>
                <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Process','Processes',2)), array('action' => 'index')); ?></li>
            </ul>

            <h5><?php echo __dn('phkapa','Ticket','Tickets',2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Ticket','Tickets',2)), array('controller' => 'tickets', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Ticket')), array('controller' => 'tickets', 'action' => 'add')); ?> </li>
            </ul>

            <h5><?php echo __dn('phkapa','Activity','Activities',2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Activity','Activities',2)), array('controller' => 'activities', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Activity')), array('controller' => 'activities', 'action' => 'add')); ?> </li>
            </ul>

            <h5><?php echo __dn('phkapa','Category','Categories',2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Category','Categories',2)), array('controller' => 'categories', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Category')), array('controller' => 'categories', 'action' => 'add')); ?> </li>
            </ul>
            <h5><?php echo __d('phkapa','Users'); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa','List %s', __d('phkapa','Users')), array('controller' => 'phkap_users', 'action' => 'index')); ?> </li>
            </ul>
        </div>

    </div>
    <div class="processes form">
        <?php echo $this->Form->create('Process'); ?>
        <fieldset class="ui-corner-all ui-widget-content" >
            <legend><?php echo __d('phkapa','Record').' '.__d('phkapa','Process'); ?></legend>
            <?php
            echo $this->Form->input('id');
            echo $this->Form->input('name',array('label' => __d('phkapa','Name')));
            echo $this->Form->input('active',array('label' => __d('phkapa','Active')));
            echo $this->Form->input('Activity',array('label' => __d('phkapa','Activity')));
            echo $this->Form->input('Category',array('label' => __d('phkapa','Category')));
            echo $this->Form->input('User',array('label' => __d('phkapa','User')));
            echo $this->Form->submit(__d('phkapa', 'Submit'));
            ?>
        </fieldset>
        <?php echo $this->Form->end(); ?>
    </div>

</div>
<div class="clear"></div>
