<?php $this->html->script('Phkapa.action_edit_add', false); ?>
<h2 class="grid_16" id="page-heading"><?php echo __d('phkapa','Add %s', __d('phkapa','Action')); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">	

        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa','Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">			
            <h5><?php echo __dn('phkapa','Action','Actions',2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Action','Actions',2)), array('action' => 'index')); ?></li>
            </ul>

            <h5><?php  echo __dn('phkapa','Ticket','Tickets',2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Ticket','Tickets',2)), array('controller' => 'tickets', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Ticket')), array('controller' => 'tickets', 'action' => 'add')); ?> </li>
            </ul>


        </div>

    </div>
    <div class="ticket-actions form">
        <?php echo $this->Form->create('Action',array('novalidate' => true)); ?>
        <fieldset class="ui-corner-all ui-widget-content" >
            <legend><?php echo __d('phkapa','Record').' '.__d('phkapa','Action'); ?></legend>
            <?php
            echo $this->Form->input('ticket_id',array('label' => __d('phkapa','Ticket'),'empty' => __d('phkapa','(choose one)')));
            echo $this->Form->input('action_type_id',array('label' => __d('phkapa','Action Type'),'empty' => __d('phkapa','(choose one)')));
            echo $this->Form->input('description',array('label' => __d('phkapa','Description')));
            echo $this->Form->input('deadline',array('min'=>'0','label' => __d('phkapa','Deadline').' ( '.__d('phkapa','Days').' )'));
            echo $this->Form->input('closed',array('label' => __d('phkapa','Closed')));
            echo $this->Form->input('close_date', array('label' => __d('phkapa','Close Date'),'empty' => __d('phkapa','(choose one)'), 'dateFormat' => 'DMY', 'maxYear' => date('Y'),'after'=>$this->Html->link( __d('phkapa','set todays date'), '#', array('style' => 'padding-left:10px;', 'id' => 'setTodayCloseDate'))));
            echo $this->Form->input('close_user_id',array('label' => __d('phkapa','Closed By'),'empty' => __d('phkapa','(choose one)')));
            echo $this->Form->input('action_effectiveness_id', array('label' => __d('phkapa','Action Effectiveness'),'empty' => __d('phkapa','(choose one)')));
            echo $this->Form->input('verify_user_id',array('label' => __d('phkapa','Verified By'),'empty' => __d('phkapa','(choose one)')));
            echo $this->Form->input('effectiveness_notes',array('label' => __d('phkapa','Effectiveness Notes')));
            echo $this->Form->input('modified', array('label' => __d('phkapa','Modified'),'empty' => __d('phkapa','(choose one)'), 'dateFormat' => 'DMY', 'maxYear' => date('Y')));
            echo $this->Form->input('created', array('label' => __d('phkapa','Created'),'empty' => __d('phkapa','(choose one)'), 'dateFormat' => 'DMY', 'maxYear' => date('Y')));
            echo $this->Form->submit(__d('phkapa', 'Submit'));
            ?>
        </fieldset>
        <?php echo $this->Form->end(); ?>
    </div>

</div>
<div class="clear"></div>
