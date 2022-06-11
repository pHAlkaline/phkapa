<h2 id="page-heading"><?php echo __d('phkapa', 'View %s', __dn('phkapa', 'User', 'Users', 1)); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">

        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa', 'Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">
            <h5><?php echo __dn('phkapa', 'User', 'Users', 2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa', 'Edit %s', __dn('phkapa', 'User', 'Users', 1)), array('action' => 'edit', $user['PhkapaUser']['id'])); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa', 'List %s', __dn('phkapa', 'User', 'Users', 2)), array('action' => 'index')); ?> </li>

            </ul>
            <h5><?php echo __dn('phkapa', 'Process', 'Processes', 2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa', 'List %s', __dn('phkapa', 'Process', 'Processes', 2)), array('controller' => 'processes', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Process')), array('controller' => 'processes', 'action' => 'add')); ?> </li>
            </ul>
        </div>

    </div>
    <div id="tabs">
        <ul>
            <li><a href="#tabs-details"><?php echo __dn('phkapa', 'Detail', 'Details', 2); ?></a></li>
            <li><a href="#tabs-processes"><?php echo __dn('phkapa', 'Process', 'Processes', 2) . ' (' . count($user['Process']) . ')'; ?></a></li>
        </ul>

        <div id="tabs-details"> 
            <div class="block">
                <dl><?php
                    $i = 0;
                    $class = ' class="altrow"';
                    ?>
                    <dt<?php
                    if ($i % 2 == 0)
                        echo $class;
                    ?>><?php echo __d('phkapa', 'Id'); ?></dt>
                    <dd<?php
                    if ($i++ % 2 == 0)
                        echo $class;
                    ?>>
                        <?php echo $user['PhkapaUser']['id']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                        if ($i % 2 == 0)
                            echo $class;
                        ?>><?php echo __d('phkapa', 'Name'); ?></dt>
                    <dd<?php
                    if ($i++ % 2 == 0)
                        echo $class;
                        ?>>
                        <?php echo h($user['PhkapaUser']['name']); ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                        if ($i % 2 == 0)
                            echo $class;
                        ?>><?php echo __d('phkapa', 'Username'); ?></dt>
                    <dd<?php
                    if ($i++ % 2 == 0)
                        echo $class;
                        ?>>
                        <?php echo h($user['PhkapaUser']['username']); ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                        if ($i % 2 == 0)
                            echo $class;
                        ?>><?php echo __d('phkapa', 'Email'); ?></dt>
                    <dd<?php
                    if ($i++ % 2 == 0)
                        echo $class;
                        ?>>
                        <?php echo h($user['PhkapaUser']['email']); ?>
                        &nbsp;
                    </dd>

                    <dt<?php
                        if ($i % 2 == 0)
                            echo $class;
                        ?>><?php echo __d('phkapa', 'Active'); ?></dt>
                    <dd<?php
                    if ($i++ % 2 == 0)
                        echo $class;
                        ?>>
                        <?php echo $this->Utils->yesOrNo($user['PhkapaUser']['active']); ?>
                        &nbsp;
                    </dd>

                </dl>
            </div>  </div>
        <div id="tabs-processes"> <div class="related">

                <?php if (!empty($user['Process'])): ?>
                    <table cellpadding = "0" cellspacing = "0">
                        <thead class="ui-state-default"
                               <tr>
                                <th><?php echo __d('phkapa', 'Id'); ?></th>
                                <th><?php echo __d('phkapa', 'Name'); ?></th>
                                <th><?php echo __d('phkapa', 'Active'); ?></th>
                                <th><?php echo __d('phkapa', 'Created'); ?></th>
                                <th><?php echo __d('phkapa', 'Modified'); ?></th>
                                <th class="actions"><?php echo __dn('phkapa', 'Action', 'Actions', 2); ?></th>
                            </tr>
                        </thead>
                        <?php
                        $i = 0;
                        foreach ($user['Process'] as $process):
                            $class = null;
                            if ($i++ % 2 == 0) {
                                $class = ' class="altrow"';
                            }
                            ?>
                            <tr<?php echo $class; ?>>
                                <td><?php echo $process['id']; ?></td>
                                <td><?php echo h($process['name']); ?></td>
                                <td><?php echo $this->Utils->yesOrNo($process['active']); ?></td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $process['created']); ?></td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $process['modified']); ?></td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__d('phkapa', 'View'), array('controller' => 'processes', 'action' => 'view', $process['id'])); ?>
                                    <?php echo ' | ' . $this->Html->link(__d('phkapa', 'Edit'), array('controller' => 'processes', 'action' => 'edit', $process['id'])); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>


            </div>
        </div>
    </div>



</div>

