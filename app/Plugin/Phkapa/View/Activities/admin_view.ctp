<h2 id="page-heading"><?php echo __d('phkapa','View %s',__d('phkapa','Activity')); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">

        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa','Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">
            <h5><?php echo __dn('phkapa','Activity','Activities',2); ?></h5>
            <ul class="menu">				
                <li><?php echo $this->Html->link(__d('phkapa','Edit %s', __d('phkapa','Activity')), array('action' => 'edit', $activity['Activity']['id'])); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Delete %s', __d('phkapa','Activity')), array('action' => 'delete', $activity['Activity']['id']), array('confirm'=> __d('phkapa','Are you sure you want to delete # %s?', $activity['Activity']['name']))); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Activity','Activities',2)), array('action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Activity')), array('action' => 'add')); ?> </li>
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
        </div>

    </div>
    <div class="box ui-corner-all ui-widget-content" >
        <div class="activities view">

            <div class="block">
                <dl><?php
$i = 0;
$class = ' class="altrow"';
?>
                    <dt<?php
                    if ($i % 2 == 0)
                        echo $class;
?>><?php echo __d('phkapa','Id'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
?>>
                            <?php echo $activity['Activity']['id']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                            if ($i % 2 == 0)
                                echo $class;
                            ?>><?php echo __d('phkapa','Name'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
                            <?php echo $activity['Activity']['name']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                            if ($i % 2 == 0)
                                echo $class;
                            ?>><?php echo __d('phkapa','Active'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
                            <?php echo $this->Utils->yesOrNo($activity['Activity']['active']); ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                            if ($i % 2 == 0)
                                echo $class;
                            ?>><?php echo __d('phkapa','Created'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
                            <?php echo $this->Time->format(Configure::read('dateFormat'), $activity['Activity']['created']); ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                            if ($i % 2 == 0)
                                echo $class;
                            ?>><?php echo __d('phkapa','Modified'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
                            <?php echo $this->Time->format(Configure::read('dateFormat'), $activity['Activity']['modified']); ?>
                        &nbsp;
                    </dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="ui-corner-all ui-widget" id="related">
        <h2>
            <a href="#" id="toggle-related-records"><?php echo __dn('phkapa','Process','Processes',2) . ' (' . count($activity['Process']) . ')'; ?></a>
        </h2>
        <div class="block ui-widget-content" id="related-records">
            <div class="related">
                <h3><?php echo __dn('phkapa','Process','Processes',2); ?></h3>
                <?php if (!empty($activity['Process'])): ?>
                    <table cellpadding = "0" cellspacing = "0">
                        <thead class="ui-state-default"
                               <tr>
                                <th><?php echo __d('phkapa','Id'); ?></th>
                                <th><?php echo __d('phkapa','Name'); ?></th>
                                <th><?php echo __d('phkapa','Active'); ?></th>
                                <th><?php echo __d('phkapa','Created'); ?></th>
                                <th><?php echo __d('phkapa','Modified'); ?></th>
                                <th class="actions"><?php echo __dn('phkapa','Action','Actions',2); ?></th>
                            </tr>
                        </thead>
                        <?php
                        $i = 0;
                        foreach ($activity['Process'] as $process):
                            $class = null;
                            if ($i++ % 2 == 0) {
                                $class = ' class="altrow"';
                            }
                            ?>
                            <tr<?php echo $class; ?>>
                                <td><?php echo $process['id']; ?></td>
                                <td><?php echo $process['name']; ?></td>
                                <td><?php echo $this->Utils->yesOrNo($process['active']); ?></td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $process['created']); ?></td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $process['modified']); ?></td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__d('phkapa','View'), array('controller' => 'processes', 'action' => 'view', $process['id'])); ?>
                                    <?php echo ' | ' . $this->Html->link(__d('phkapa','Edit'), array('controller' => 'processes', 'action' => 'edit', $process['id'])); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>

                <div class="actions">
                    <ul>
                        <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Process')), array('controller' => 'processes', 'action' => 'add','activity',$activity['Activity']['id'])); ?> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
