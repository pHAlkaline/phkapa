<?php
$closeOk = false;
$closeMessage = '';

if (isset($ticket['Action']) && count($ticket['Action']) > 0) {
    $closeOk = true;
    foreach ($ticket['Action'] as $action):

        if ($action['ActionType']['verification'] != 0 && ($action['action_effectiveness_id'] == '1' || $action['action_effectiveness_id'] == null)) {
            $closeOk = false;
        }
        if ($action['ActionType']['verification'] != 0 && $action['action_effectiveness_id'] != '2') {

            $closeMessage = __d('phkapa', 'This ticket has actions that were not effective, please choose cancel if you want replan or create a new related ticket before closing.');
        }
    endforeach;
}
?>
<h2 id="page-heading"><?php echo __d('phkapa', 'Verify') . ':' . __d('phkapa', 'View %s', __d('phkapa', 'Ticket')); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">	
        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa', 'Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">
            <h5><?php echo __dn('phkapa', 'Ticket', 'Tickets', 2); ?></h5>
            <ul class="menu">
                <?php if ($closeOk) : ?>
                    <li>
                        <?php echo $this->Html->link(__d('phkapa', 'Close'), array('action' => 'close', $ticket['Ticket']['id']), null, __d('phkapa', 'Are you sure you want to close # %s?', $ticket['Ticket']['id']) . ' ' . $closeMessage);
                        ?>
                    </li>
                <?php endif; ?>
                <?php //if ($closeMessage!='') : ?>
                <li>
                    <?php echo $this->Html->link(__d('phkapa', 'Replan'), array('action' => 'replan', $ticket['Ticket']['id']), null, __d('phkapa', 'Are you sure you want to replan # %s?', $ticket['Ticket']['id']));
                    ?>
                </li>
                <?php //endif; ?>

                
                <li><?php echo $this->Html->link(__d('phkapa', 'Open new related ticket'), array('controller' => 'register', 'action' => 'add', $ticket['Ticket']['id'])); ?></li>
                <li><?php echo $this->Html->link(__d('phkapa', 'List %s', __dn('phkapa', 'Ticket', 'Tickets', 2)), array('action' => 'index')); ?> </li>
           

            </ul>

        </div>

    </div>
    <div class="box ui-corner-all ui-widget-content" >
        <div class="tickets view">

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
                            <?php echo $ticket['Ticket']['id']; ?>
                        &nbsp;
                    </dd>
                    <?php if ($ticket['Ticket']['ticket_parent'] != '') { ?>
                        <dt<?php
                    if ($i % 2 == 0)
                        echo $class;
                        ?>><?php echo __d('phkapa', 'Ticket Parent'); ?></dt>
                        <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                        ?>>
                                <?php
                                echo $this->Html->link($ticket['Ticket']['ticket_parent'] . ' ' . $this->Html->image("accept.png", array("alt" => __d('phkapa', "See ticket parent data"), "style" => "padding-left:100px;")) . ' ' . __d('phkapa', "See ticket parent data"), array('controller' => 'query', 'action' => 'view', $ticket['Ticket']['ticket_parent']), array('escape' => false));
                                ?>
                            &nbsp;
                        </dd>
                    <?php } ?>
                    <dt<?php
                            if ($i % 2 == 0)
                                echo $class;
                            ?>><?php echo __d('phkapa', 'Registar'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
                            <?php echo $ticket['Registar']['name']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                    if ($i % 2 == 0)
                        echo $class;
                    ?>><?php echo __d('phkapa', 'Priority'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                    ?>>
                            <?php echo $ticket['Priority']['name']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                            if ($i % 2 == 0)
                                echo $class;
                            ?>><?php echo __d('phkapa', 'Origin Date'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
                            <?php
                            if ($ticket['Ticket']['origin_date']) {
                                echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['origin_date']);
                            }
                            ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                            if ($i % 2 == 0)
                                echo $class;
                            ?>><?php echo __d('phkapa', 'Type'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
                            <?php echo $ticket['Type']['name']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                            if ($i % 2 == 0)
                                echo $class;
                            ?>><?php echo __d('phkapa', 'Origin'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
                            <?php echo $ticket['Origin']['name']; ?>
                        &nbsp;
                    </dd>

                    <dt<?php
                            if ($i % 2 == 0)
                                echo $class;
                            ?>><?php echo __d('phkapa', 'Process'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
                            <?php echo $ticket['Process']['name']; ?>
                        &nbsp;
                    </dd>

                    <dt<?php
                            if ($i % 2 == 0)
                                echo $class;
                            ?>><?php echo __d('phkapa', 'Activity'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
                            <?php echo $ticket['Activity']['name']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                            if ($i % 2 == 0)
                                echo $class;
                            ?>><?php echo __d('phkapa', 'Category'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
                            <?php echo $ticket['Category']['name']; ?>
                        &nbsp;
                    </dd>

                    <dt<?php
                            if ($i % 2 == 0)
                                echo $class;
                            ?>><?php echo __d('phkapa', 'Supplier'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
                            <?php echo $ticket['Supplier']['name']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                            if ($i % 2 == 0)
                                echo $class;
                            ?>><?php echo __d('phkapa', 'Description'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
                            <?php echo $ticket['Ticket']['description'].'<br/>'.$ticket['Ticket']['review_notes']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                            if ($i % 2 == 0)
                                echo $class;
                            ?>><?php echo __d('phkapa', 'Cause'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
                            <?php echo $ticket['Cause']['name']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                            if ($i % 2 == 0)
                                echo $class;
                            ?>><?php echo __d('phkapa', 'Cause Notes'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
                            <?php echo $ticket['Ticket']['cause_notes']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                            if ($i % 2 == 0)
                                echo $class;
                            ?>><?php echo __d('phkapa', 'Last Modification By'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
                            <?php echo $ticket['ModifiedUser']['name']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                            if ($i % 2 == 0)
                                echo $class;
                            ?>><?php echo __d('phkapa', 'Modified'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
                            <?php echo $this->Time->format(Configure::read('dateFormat'), $ticket['Ticket']['modified']); ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                            if ($i % 2 == 0)
                                echo $class;
                            ?>><?php echo __d('phkapa', 'Created'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
                            <?php echo $this->Time->format(Configure::read('dateFormat'), $ticket['Ticket']['created']); ?>
                        &nbsp;
                    </dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="ui-corner-all ui-widget" id="related">
        <h2>
            <a href="#" id="toggle-related-records"><?php echo (__dn('phkapa', 'Action', 'Actions', 2)); ?></a>
        </h2>
        <div class="block ui-widget-content" id="related-records">
            <div class="related">

                <?php if (!empty($ticket['Action'])): ?>
                    <table cellpadding = "0" cellspacing = "0">
                        <thead class="ui-state-default"
                               <tr>
                                <th><?php echo __d('phkapa', 'Id'); ?></th>
                                <th><?php echo __d('phkapa', 'Action Type'); ?></th>
                                <th><?php echo __d('phkapa', 'Description'); ?></th>
                                <th><?php echo __d('phkapa', 'Effectiveness'); ?></th>
                                <th><?php echo __d('phkapa', 'Effectiveness Notes'); ?></th>
                                <th><?php echo __d('phkapa', 'Created'); ?></th>
                                <th><?php echo __d('phkapa', 'Close Date'); ?></th>
                                <th><?php echo __d('phkapa', 'After Deadline'); ?></th>
                                <th class="actions"><?php echo __dn('phkapa', 'Action', 'Actions', 2); ?></th>
                            </tr>
                        </thead>
                        <?php
                        $i = 0;
                        foreach ($ticket['Action'] as $action):
                            $dayDescription = ($action['deadline'] == 1) ? 'day' : 'days';
                            $expiry = strtotime(date($action['created']) . " +" . $action['deadline'] . $dayDescription);
                            $closeDate = strtotime($action['close_date']);
                            $afterexpiry = $closeDate - $expiry;
                            $afterexpiry = floor($afterexpiry / (24 * 60 * 60));
                            if ($afterexpiry > 0) {
                                //$afterexpiry = $afterexpiry;
                            } else {
                                $afterexpiry = 0;
                            }

                            $class = null;
                            if ($i++ % 2 == 0) {
                                $class = ' class="altrow"';
                            }
                            ?>
                            <tr<?php echo $class; ?>>
                                <td><?php echo $action['id']; ?></td>
                                <td><?php echo $action['ActionType']['name']; ?></td>
                                <td><?php echo $action['description']; ?></td>
                                <td><?php
                    if (isset($action['ActionEffectiveness']['name']))
                        echo $action['ActionEffectiveness']['name'];
                            ?></td>
                                <td><?php echo $action['effectiveness_notes']; ?></td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $action['created']); ?></td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $action['close_date']); ?></td>
                                <td class="nowrap"><?php echo $afterexpiry; ?></td>
                                <td class="actions">
                                    <?php
                                    if ($action['ActionType']['verification'] != 0) {
                                        echo $this->Html->link(__d('phkapa', 'Edit'), array('action' => 'edit_action', $action['id'], $ticket['Ticket']['id']));
                                    }
                                    ?>

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
