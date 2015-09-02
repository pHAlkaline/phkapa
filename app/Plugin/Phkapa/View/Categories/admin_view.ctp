<h2 id="page-heading"><?php echo __d('phkapa','View %s', __d('phkapa','Category')); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">

        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa','Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">
            <h5><?php echo __dn('phkapa','Category','Categories',2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa','Edit %s', __d('phkapa','Category')), array('action' => 'edit', $category['Category']['id'])); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Delete %s', __d('phkapa','Category')), array('action' => 'delete', $category['Category']['id']), array('confirm'=> __d('phkapa','Are you sure you want to delete # %s?', $category['Category']['name']))); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Category','Categories',2)), array('action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Category')), array('action' => 'add')); ?> </li>
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
        <div class="categories view">

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
                            <?php echo $category['Category']['id']; ?>
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
                            <?php echo $category['Category']['name']; ?>
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
                            <?php echo $this->Utils->yesOrNo($category['Category']['active']); ?>
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
                            <?php echo $this->Time->format(Configure::read('dateFormat'), $category['Category']['created']); ?>
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
                            <?php echo $this->Time->format(Configure::read('dateFormat'), $category['Category']['modified']); ?>
                        &nbsp;
                    </dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="ui-corner-all ui-widget" id="related">
        <h2>
            <a href="#" id="toggle-related-records"><?php echo __dn('phkapa','Process','Processes',2) . ' (' . count($category['Process']) . ')' . ' - ' . __dn('phkapa','Cause','Causes',2) . ' (' . count($category['Cause']) . ')'; ?></a>
        </h2>
        <div class="block ui-widget-content" id="related-records">
            <div class="related">
                <h3><?php echo __dn('phkapa','Process','Processes',2); ?></h3>
                <?php if (!empty($category['Process'])): ?>
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
                        foreach ($category['Process'] as $process):
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
                        <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Process')), array('controller' => 'processes', 'action' => 'add','category',$category['Category']['id'])); ?> </li>
                    </ul>
                </div>
            </div>
            <div class="related">
                <h3><?php echo __dn('phkapa','Cause','Causes',2); ?></h3>
                <?php if (!empty($category['Cause'])): ?>
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
                        foreach ($category['Cause'] as $cause):
                            $class = null;
                            if ($i++ % 2 == 0) {
                                $class = ' class="altrow"';
                            }
                            ?>
                            <tr<?php echo $class; ?>>
                                <td><?php echo $cause['id']; ?></td>
                                <td><?php echo $cause['name']; ?></td>
                                <td><?php echo $this->Utils->yesOrNo($cause['active']); ?></td>
                                <td><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $cause['created']); ?></td>
                                <td><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $cause['modified']); ?></td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__d('phkapa','View'), array('controller' => 'causes', 'action' => 'view', $cause['id'])); ?>
                                    <?php echo ' | ' . $this->Html->link(__d('phkapa','Edit'), array('controller' => 'causes', 'action' => 'edit', $cause['id'])); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>

                <div class="actions">
                    <ul>
                        <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Cause')), array('controller' => 'causes', 'action' => 'add','category',$category['Category']['id'])); ?> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="clear"></div>
