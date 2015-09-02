<h2 id="page-heading"><?php echo __d('phkapa','View %s', __d('phkapa','Process')); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">

        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa','Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">
            <h5><?php echo __dn('phkapa','Process','Processes',2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa','Edit %s', __d('phkapa','Process')), array('action' => 'edit', $process['Process']['id'])); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Delete %s', __d('phkapa','Process')), array('action' => 'delete', $process['Process']['id']), array('confirm'=> __d('phkapa','Are you sure you want to delete # %s?', $process['Process']['name']))); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Process','Processes',2)), array('action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Process')), array('action' => 'add')); ?> </li>
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
                <li><?php echo $this->Html->link(__d('phkapa','List %s', __d('phkapa','Users')), array('controller' => 'users', 'action' => 'index')); ?> </li>
            </ul>
        </div>

    </div>
    <div class="box ui-corner-all ui-widget-content" >
        <div class="processes view">

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
                            <?php echo $process['Process']['id']; ?>
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
                            <?php echo $process['Process']['name']; ?>
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
                            <?php echo $this->Utils->yesOrNo($process['Process']['active']); ?>
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
                            <?php echo $this->Time->format(Configure::read('dateFormat'), $process['Process']['created']); ?>
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
                            <?php echo $this->Time->format(Configure::read('dateFormat'), $process['Process']['modified']); ?>
                        &nbsp;
                    </dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="ui-corner-all ui-widget" id="related">
        <h2>
            <a href="#" id="toggle-related-records"><?php echo __dn('phkapa','Activity','Activities',2) . ' (' . count($process['Activity']) . ')' . ' - ' . __dn('phkapa','Category','Categories',2) . ' (' . count($process['Category']) . ')' . ' - ' . __d('phkapa','Users') . ' (' . count($process['User']) . ')'; ?></a>
        </h2>
        <div class="block ui-widget-content" id="related-records">
            <div class="related">
                <h3><?php echo __dn('phkapa','Activity','Activities',2); ?></h3>
                <?php if (!empty($process['Activity'])): ?>
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
                        foreach ($process['Activity'] as $activity):
                            $class = null;
                            if ($i++ % 2 == 0) {
                                $class = ' class="altrow"';
                            }
                            ?>
                            <tr<?php echo $class; ?>>
                                <td><?php echo $activity['id']; ?></td>
                                <td><?php echo $activity['name']; ?></td>
                                <td><?php echo $this->Utils->yesOrNo($activity['active']); ?></td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $activity['created']); ?></td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $activity['modified']); ?></td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__d('phkapa','View'), array('controller' => 'activities', 'action' => 'view', $activity['id'])); ?>
                                    <?php echo ' | ' . $this->Html->link(__d('phkapa','Edit'), array('controller' => 'activities', 'action' => 'edit', $activity['id'])); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>

                <div class="actions">
                    <ul>
                        <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Activity')), array('controller' => 'activities', 'action' => 'add','process',$process['Process']['id'])); ?> </li>
                    </ul>
                </div>
            </div>
            <div class="related">
                <h3><?php echo __dn('phkapa','Category','Categories',2); ?></h3>
                <?php if (!empty($process['Category'])): ?>
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
                        foreach ($process['Category'] as $category):
                            $class = null;
                            if ($i++ % 2 == 0) {
                                $class = ' class="altrow"';
                            }
                            ?>
                            <tr<?php echo $class; ?>>
                                <td><?php echo $category['id']; ?></td>
                                <td><?php echo $category['name']; ?></td>
                                <td><?php echo $this->Utils->yesOrNo($category['active']); ?></td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $category['created']); ?></td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $category['modified']); ?></td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__d('phkapa','View'), array('controller' => 'categories', 'action' => 'view', $category['id'])); ?>
                                    <?php echo ' | ' . $this->Html->link(__d('phkapa','Edit'), array('controller' => 'categories', 'action' => 'edit', $category['id'])); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>

                <div class="actions">
                    <ul>
                        <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Category')), array('controller' => 'categories', 'action' => 'add','process',$process['Process']['id'])); ?> </li>
                    </ul>
                </div>
            </div>
            <div class="related">
                <h3><?php echo __dn('phkapa','User','Users',2); ?></h3>
                <?php if (!empty($process['User'])): ?>
                    <table cellpadding = "0" cellspacing = "0">
                        <thead class="ui-state-default"
                               <tr>
                                <th><?php echo __d('phkapa','Id'); ?></th>
                                <th><?php echo __d('phkapa','Name'); ?></th>
                                <th><?php echo __d('phkapa','Active'); ?></th>
                                <th><?php echo __d('phkapa','Modified'); ?></th>
                                <th><?php echo __d('phkapa','Created'); ?></th>
                                <th class="actions"><?php echo __dn('phkapa','Action','Actions',2); ?></th>
                            </tr>
                        </thead>
                        <?php
                        $i = 0;
                        foreach ($process['User'] as $user):
                            $class = null;
                            if ($i++ % 2 == 0) {
                                $class = ' class="altrow"';
                            }
                            ?>
                            <tr<?php echo $class; ?>>
                                <td><?php echo $user['id']; ?></td>
                                <td><?php echo $user['name']; ?></td>
                                <td><?php echo $this->Utils->yesOrNo($user['active']); ?></td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $user['modified']); ?></td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $user['created']); ?></td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__d('phkapa','View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
                                    <?php echo ' | ' . $this->Html->link(__d('phkapa','Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>

                
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>