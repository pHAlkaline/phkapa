<?php
$hasCause = true;
$openActions = FALSE;
$sendOk = true;
$closeOk = true;
$verificationCount = 0;
$hasFlag = false;
$showActions = true;


// No cause 
if ($ticket['Ticket']['cause_id'] == null) {
    $hasCause = false;
    $sendOk = false;
    $closeOk = false;
}

// Has Cause but no actions
if ($hasCause && isset($ticket['Action']) && count($ticket['Action']) == 0) {
    $sendOk = false;
    $closeOk = true;
}

// Has Cause and actions
if ($hasCause && isset($ticket['Action']) && count($ticket['Action']) > 0) {

    foreach ($ticket['Action'] as $action):

        // Has open actions
        if ($action['closed'] == 0) {
           
            $sendOk = false;
            $closeOk = false;
            $openActions = true;
        }
        // Has verification type actions
        if ($action['ActionType']['verification'] == '1') {
           
            $verificationCount++;
        }

    endforeach;

    //Has Cause , no open actions, has actions need verifications
    if (!$openActions && $verificationCount>0) {
        
        $sendOk = true;
        $closeOk = false;
    }
    
    //Has Cause , no open actions, no actions need verifications
    if (!$openActions && $verificationCount==0) {
        
        $sendOk = false;
        $closeOk = true;
    }
}



?>
<h2 id="page-heading"><?php echo __d('phkapa', 'Plan'); ?> : <?php echo __d('phkapa', 'Ticket'); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">
        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa', 'Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">
            <h5><?php echo __dn('phkapa', 'Ticket', 'Tickets', 2); ?></h5>
            <ul class="menu">
                <li>
                    <?php
                    if ($sendOk) {
                        echo $this->Html->link(__d('phkapa', 'Send %s', __d('phkapa', 'Ticket')), array('action' => 'send', $ticket['Ticket']['id']), null, __d('phkapa', 'Are you sure you want to send # %s?', $ticket['Ticket']['id']));
                    }
                    if ($closeOk) {
                        echo $this->Html->link(__d('phkapa', 'Close %s', __d('phkapa', 'Ticket')), array('action' => 'close', $ticket['Ticket']['id']), null, __d('phkapa', 'Are you sure you want to close # %s?', $ticket['Ticket']['id']));
                    }
                    ?>
                </li>
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
                        ?>><?php echo __d('phkapa', 'Safety'); ?></dt>
                    <dd<?php
                    if ($i++ % 2 == 0)
                        echo $class;
                        ?>>
                        <?php echo $ticket['Safety']['name']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                        if ($i % 2 == 0)
                            echo $class;
                        ?>><?php echo __d('phkapa', 'Safety'); ?></dt>
                    <dd<?php
                    if ($i++ % 2 == 0)
                        echo $class;
                        ?>>
                        <?php echo $ticket['Safety']['name']; ?>
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
                        <?php echo $ticket['Ticket']['description'] . '<br/>' . $ticket['Ticket']['review_notes']; ?>
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
    <div class="tickets form" >
        <?php echo $this->Form->create(); ?>
        <fieldset class="ui-corner-all ui-widget-content" >
            <legend><?php echo __d('phkapa', 'Record %s', __d('phkapa', 'Cause')); ?></legend>
            <?php
            echo $this->Form->input('id');
            echo $this->Form->input('cause_id', array('label' => __d('phkapa', 'Cause'), 'empty' => __d('phkapa', '(choose one)')));
            echo $this->Form->input('cause_notes', array('label' => __d('phkapa', 'Cause Notes')));
            echo $this->Form->submit(__d('phkapa', 'Submit'));
            ?>
        </fieldset>
        <?php echo $this->Form->end(); ?>
    </div>
    <?php if ($showActions) { ?>
        <div class="ui-corner-all ui-widget" id="related">
            <h2>
                <a href="#" id="toggle-related-records"><?php echo __d('phkapa', 'List %s', __dn('phkapa', 'Action', 'Actions', 2)) . ' / ' . __d('phkapa', 'Plan'); ?></a>
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
                                    <th><?php echo __d('phkapa', 'Created'); ?></th>
                                    <th><?php echo __d('phkapa', 'Deadline'); ?></th>
                                    <th><?php echo __d('phkapa', 'Expiry'); ?></th>
                                    <th><?php echo __d('phkapa', 'Closed'); ?></th>
                                    <th><?php echo __d('phkapa', 'Closed By'); ?></th>
                                    <th><?php echo __d('phkapa', 'Close Date'); ?></th>
                                    <th class="actions"><?php echo __dn('phkapa', 'Action', 'Actions', 2); ?></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <?php
                            $i = 0;
                            foreach ($ticket['Action'] as $action):
                                $class = null;

                                if ($i++ % 2 == 0) {
                                    $class = ' class="altrow"';
                                }

                                $expiry = '';
                                $red = '';
                                $dayDescription = ($action['deadline'] == 1) ? ' day' : ' days';
                                $expiry = strtotime(date($action['created']) . " +" . $action['deadline'] . $dayDescription);

                                $deadlineAgo = '';
                                $hasFlag = false;
                                $flag = "red_flag_action.png";
                                $flagMessage = __d('phkapa', 'Action deadline expired!!!');


                                if ($action['closed'] == 0 && !$this->Time->wasWithinLast($action['deadline'] . $dayDescription, $action['created'])) {
                                    $deadlineAgo = ' ( ' . $this->Time->timeAgoInWords($expiry, $options = array(), $backwards = null) . ' ) ';
                                    $red = "red";
                                    $hasFlag = true;
                                }
                                ?>
                                <tr<?php echo $class; ?>>
                                    <td><?php echo $action['id']; ?></td>

                                    <td><?php echo $action['ActionType']['name']; ?></td>
                                    <td><?php echo $action['description']; ?></td>
                                    <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $action['created']); ?></td>
                                    <td class="nowrap"><?php echo $action['deadline'] . ' ' . __d('phkapa', 'Days'); ?></td>
                                    <td class="nowrap <?php echo $red ?>"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $expiry) . ' ' . $deadlineAgo; ?></td>
                                    <td class="nowrap"><?php echo $this->Utils->yesOrNo($action['closed']); ?></td>
                                    <td><?php if (isset($action['CloseUser']['name'])) echo $action['CloseUser']['name']; ?>&nbsp;</td>
                                    <td class="nowrap"><?php
                    if ($action['close_date'])
                        echo $this->Time->format(Configure::read('dateFormatSimple'), $action['close_date']);
                                ?></td>
                                    

                                    <td class="nowrap actions">
                                        <?php echo $this->Html->link(__d('phkapa', 'Edit'), array('action' => 'edit_action', $action['id'], $ticket['Ticket']['id'])); ?>
                                        <?php echo ' | ' . $this->Html->link(__d('phkapa', 'Delete'), array('action' => 'delete_action', $action['id'], $ticket['Ticket']['id']), null, __d('phkapa', 'Are you sure you want to delete # %s?', $action['id'])); ?>
                                        <?php
                                        if ($action['closed'] == 0) {
                                            echo ' | ' . $this->Html->link(__d('phkapa', 'Close'), array('action' => 'close_action', $action['id'], $ticket['Ticket']['id']), null, __d('phkapa', 'Are you sure you want to close # %s?', $action['id']));
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($hasFlag)
                                            echo $this->Html->image($flag, array('alt' => $flagMessage, 'title' => $flagMessage, 'style' => 'vertical-align: middle;cursor:help;'))
                                            ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>


                    <div class="actions">

                        <ul>
                            <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Action')), array('action' => 'add_action', $ticket['Ticket']['id'])); ?> </li>
                        </ul>


                    </div>

                </div>
            </div>
        </div>
    <?php } ?>
</div>
<div class="clear"></div>
