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
                    <li><?php echo $this->Html->link(__d('phkapa','Delete %s', __d('phkapa','Action')), array('action' => 'delete', $action['Action']['id']), array('confirm'=> __d('phkapa','Are you sure you want to delete # %s?', $action['Action']['id']))); ?> </li>
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
                        
                        <?php echo $this->Html->link($action['ActionType']['name'], array('controller' => 'action_types', 'action' => 'view', $action['ActionType']['id'])); ?>&nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __d('phkapa','Description'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php echo $this->Text->autoParagraph($action['Action']['description']); ?>
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
                                echo $class; ?>><?php echo __d('phkapa','Closed By'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                        <?php echo $this->Html->link($action['CloseUser']['name'], array('controller' => 'users', 'action' => 'view', $action['CloseUser']['id'])); ?>&nbsp;
                    </dd>
                    
                    <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __d('phkapa','Close Date'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php if ($action['Action']['close_date'] != '')
                                echo $this->Time->format(Configure::read('dateFormatSimple'), $action['Action']['close_date']); ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __d('phkapa','Effectiveness'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                           <?php echo $this->Html->link($action['ActionEffectiveness']['name'], array('controller' => 'users', 'action' => 'view', $action['ActionEffectiveness']['id'])); ?>&nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __d('phkapa','Verified By'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php echo $this->Html->link($action['VerifyUser']['name'], array('controller' => 'users', 'action' => 'view', $action['VerifyUser']['id'])); ?>&nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __d('phkapa','Effectiveness Notes'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php echo $this->Text->autoParagraph($action['Action']['effectiveness_notes']); ?>
                        &nbsp;
                    </dd>
                     <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __d('phkapa','Last Modification By'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php echo $this->Html->link($action['ModifiedUser']['name'], array('controller' => 'users', 'action' => 'view', $action['ModifiedUser']['id'])); ?>&nbsp;
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
    <div class="ui-corner-all ui-widget" id="related">
        <h2>
            <a href="#" id="toggle-related-records"><?php echo __d('phkapa', 'Related'); ?></a>
        </h2>
        <div class="block ui-widget-content" id="related-records">
           
           
            <div class="related">
                <h3><?php echo __dn('phkapa', 'Revision','Revisions',2); ?></h3>
                <?php if (!empty($action_revisions)): ?>
                    <table cellpadding = "0" cellspacing = "0">
                        <thead class="ui-state-default"
                               <tr>
                                <th><?php echo __d('phkapa', 'Id'); ?></th>
                                <th><?php echo __d('phkapa', 'Request'); ?></th>
                                <th><?php echo __d('phkapa', 'Modified'); ?></th>
                                <th><?php echo __d('phkapa', 'Last Modification By'); ?></th>
                                <th><?php echo __dn('phkapa', 'Action', 'Actions', 2); ?></th>

                            </tr>
                        </thead>
                        <?php
                        $i = 0;
                        foreach ($action_revisions as $revision):
                            $revision['Action']=$revision['Revision_Action'];

                            
                            $class = null;
                            if ($i++ % 2 == 0) {
                                $class = ' class="altrow"';
                            }
                            ?>
                            <tr<?php echo $class; ?>>
                                <td><?php echo $revision['Action']['version_id']; ?>&nbsp;</td>
                                <td><?php echo $revision['Action']['version_request']; ?>&nbsp;</td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormat'), $revision['Action']['modified']); ?>&nbsp;</td>
                                <td>
                                    <?php echo $revision['ModifiedUser']['name']; ?>
                                </td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__d('phkapa', 'View'), array('action' => 'view_revision', $revision['Action']['version_id'], $revision['Action']['id'])); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php //echo '<tfoot class=\'dark\'>'.$tableHeaders.'</tfoot>';    ?>    </table>
                <?php endif; ?>

                
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
