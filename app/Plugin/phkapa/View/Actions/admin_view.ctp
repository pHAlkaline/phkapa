<h2 id="page-heading"><?php echo __d('phkapa','View %s', __d('phkapa','Action')); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">
      	
            <h2>
                <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa','Menu'); ?></a>
            </h2>
            <div class="block" id="admin-actions">
                <h5><?php echo __dn('phkapa','Action','Actions',2); ?></h5>
                <ul class="menu">				
                    <li><?php echo $this->Html->link(__d('phkapa','Edit %s', __d('phkapa','Action')), array('action' => 'edit', $action['Action']['id'])); ?> </li>
                    <li><?php echo $this->Html->link(__d('phkapa','Delete %s', __d('phkapa','Action')), array('action' => 'delete', $action['Action']['id']), null, __d('phkapa','Are you sure you want to delete # %s?', $action['Action']['id'])); ?> </li>
                    <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Action','Actions',2)), array('action' => 'index')); ?> </li>
                    <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Action')), array('action' => 'add')); ?> </li>
                </ul>			

                <h5><?php echo __dn('phkapa','Ticket','Tickets',2); ?></h5>
                <ul class="menu">
                    <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Ticket','Tickets',2)), array('controller' => 'tickets', 'action' => 'index')); ?> </li>
                    <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Ticket')), array('controller' => 'tickets', 'action' => 'add')); ?> </li>
                </ul>
            </div>
       
    </div>
    <div class="box ui-corner-all ui-widget-content" >
        <div class="actions view">

            <div class="block">
                <dl><?php $i = 0;
$class = ' class="altrow"'; ?>
                    <dt<?php if ($i % 2 == 0)
                        echo $class; ?>><?php echo __d('phkapa','Id'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php echo $action['Action']['id']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __d('phkapa','Ticket'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php echo $this->Html->link($action['Ticket']['id'], array('controller' => 'tickets', 'action' => 'view', $action['Ticket']['id'])); ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __d('phkapa','Action Type'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php echo $action['ActionType']['name']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __d('phkapa','Description'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php echo $action['Action']['description']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __d('phkapa','Deadline'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php echo $action['Action']['deadline'].' '.__d('phkapa','Days'); ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __d('phkapa','Closed'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php echo $this->Utils->yesOrNo($action['Action']['closed']); ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __d('phkapa','Close Date'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php if ($action['Action']['close_date'] != '')
                                echo $this->Time->format(Configure::read('dateFormat'), $action['Action']['close_date']); ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __d('phkapa','Effectiveness'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php echo $action['ActionEffectiveness']['name']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __d('phkapa','Effectiveness Notes'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php echo $action['Action']['effectiveness_notes']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __d('phkapa','Modified'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php echo $this->Time->format(Configure::read('dateFormat'), $action['Action']['modified']); ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __d('phkapa','Created'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php echo $this->Time->format(Configure::read('dateFormat'), $action['Action']['created']); ?>
                        &nbsp;
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
