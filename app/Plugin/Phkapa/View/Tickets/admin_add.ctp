<?php $this->html->script('Phkapa.ticket_add', false); ?>
<h2 class="grid_16" id="page-heading"><?php echo __d('phkapa', 'Add %s', __d('phkapa', 'Ticket')); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">

        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa', 'Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">
            <h5><?php echo __dn('phkapa', 'Ticket', 'Tickets', 2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa', 'List %s', __dn('phkapa', 'Ticket', 'Tickets', 2)), array('action' => 'index')); ?></li>
            </ul>
            <h5><?php echo __dn('phkapa', 'Option', 'Options', 2); ?></h5>
            <ul class="menu">

                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Priority')), array('controller' => 'priorities', 'action' => 'add')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Safety')), array('controller' => 'safeties', 'action' => 'add')); ?> </li>

                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Type')), array('controller' => 'types', 'action' => 'add')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Origin')), array('controller' => 'origins', 'action' => 'add')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Process')), array('controller' => 'processes', 'action' => 'add')); ?> </li>


                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Activity')), array('controller' => 'activities', 'action' => 'add')); ?> </li>

                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Category')), array('controller' => 'categories', 'action' => 'add')); ?> </li>



                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Supplier')), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Customer')), array('controller' => 'customers', 'action' => 'add')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Cause')), array('controller' => 'causes', 'action' => 'add')); ?> </li>
            </ul>

        </div>
    </div>



    <div class="tickets form">
         <?php echo $this->Form->create('Ticket',array('novalidate' => true)); ?>
        <fieldset class="ui-corner-all ui-widget-content" >
            <legend><?php echo __d('phkapa', 'Record') . ' ' . __d('phkapa', 'Ticket'); ?></legend>
            <?php
            echo $this->Form->hidden('filter_change');
            echo $this->Form->input('workflow_id', array('label' => __d('phkapa', 'Workflow'), 'empty' => __d('phkapa', '(choose one)')));
            echo $this->Form->input('registar_id', array('label' => __d('phkapa', 'Registar'), 'empty' => __d('phkapa', '(choose one)')));
            echo $this->Form->input('priority_id', array('label' => __d('phkapa', 'Priority'), 'empty' => __d('phkapa', '(choose one)')));
            echo $this->Form->input('safety_id', array('label' => __d('phkapa', 'Safety'), 'empty' => __d('phkapa', '(choose one)')));
            echo $this->Form->input('origin_date', array('label' => __d('phkapa', 'Origin Date'), 'empty' => __d('phkapa', '(choose one)'), 'dateFormat' => 'DMY', 'minYear' => date('Y') - 1, 'maxYear' => date('Y'), 'after' => $this->Html->link(__d('phkapa', 'set todays date'), '#', array('style' => 'padding-left:10px;', 'id' => 'setTodayOriginDate'))));
            echo $this->Form->input('type_id', array('label' => __d('phkapa', 'Type'), 'empty' => __d('phkapa', '(choose one)')));
            echo $this->Form->input('origin_id', array('label' => __d('phkapa', 'Origin'), 'empty' => __d('phkapa', '(choose one)')));
            echo $this->Form->input('process_id', array('label' => __d('phkapa', 'Process'), 'empty' => __d('phkapa', '(choose one)')));
            echo $this->Form->input('activity_id', array('label' => __d('phkapa', 'Activity'), 'empty' => __d('phkapa', '(choose one)')));
            echo $this->Form->input('category_id', array('label' => __d('phkapa', 'Category'), 'empty' => __d('phkapa', '(choose one)')));
            echo $this->Form->input('product',array('label' => __d('phkapa','Product')));
            echo $this->Form->input('supplier_id', array('label' => __d('phkapa', 'Supplier'), 'empty' => __d('phkapa', '(choose one)')));
            echo $this->Form->input('customer_id', array('label' => __d('phkapa', 'Customer'), 'empty' => __d('phkapa', '(choose one)')));
            echo $this->Form->input('approved', array('label' => __d('phkapa', 'Approved')));
            echo $this->Form->input('review_notes', array('label' => __d('phkapa', 'Review Notes')));
            echo $this->Form->input('description', array('label' => __d('phkapa', 'Description')));
            echo $this->Form->input('cause_id', array('label' => __d('phkapa', 'Cause'), 'empty' => __d('phkapa', '(choose one)')));
            echo $this->Form->input('cause_notes', array('label' => __d('phkapa', 'Cause Notes')));
            echo "<hr/>";
            echo $this->Form->input('ticket_parent', array('min' => '0', 'label' => __d('phkapa', 'Ticket Parent')));
            echo "<hr/>";
            echo $this->Form->input('close_date', array('label' => __d('phkapa', 'Close Date'), 'empty' => __d('phkapa', '(choose one)'), 'dateFormat' => 'DMY', 'minYear' => date('Y') - 1, 'maxYear' => date('Y'), 'after' => $this->Html->link(__d('phkapa', 'set todays date'), '#', array('style' => 'padding-left:10px;', 'id' => 'setTodayCloseDate'))));
            echo $this->Form->input('close_user_id', array('label' => __d('phkapa', 'Closed By'), 'empty' => __d('phkapa', '(choose one)')));
            echo $this->Form->input('modified', array('label' => __d('phkapa', 'Modified'), 'empty' => __d('phkapa', '(choose one)'), 'dateFormat' => 'DMY', 'minYear' => date('Y') - 1, 'maxYear' => date('Y')));
            echo $this->Form->input('created', array('label' => __d('phkapa', 'Created'), 'empty' => __d('phkapa', '(choose one)'), 'dateFormat' => 'DMY', 'minYear' => date('Y') - 1, 'maxYear' => date('Y')));
            echo $this->Form->submit(__d('phkapa', 'Submit'));
            ?>
        </fieldset>
        <?php echo $this->Form->end(); ?>
    </div>

</div>
<div class="clear"></div>
