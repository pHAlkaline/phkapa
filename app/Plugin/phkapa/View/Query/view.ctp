
<?php
$editable = false;
$controller = null;
$action = null;
if ($ticket['Workflow']['id'] < 5) {
    $editable = true;
    switch ($ticket['Workflow']['id']) {
        case 1:
            $controller = 'register';
            $action = 'edit';
            break;
        case 2:
            $controller = 'review';
            $action = 'edit';
            break;
        case 3:
            $controller = 'plan';
            $action = 'edit';
            break;
        case 4:
            $controller = 'verify';
            $action = 'view';
            break;
    }
}
?>
<h2 id="page-heading"><?php echo __d('phkapa', 'View %s', __d('phkapa', 'Ticket')); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">
        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa', 'Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">
            <h5><?php echo __dn('phkapa', 'Ticket', 'Tickets', 2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa', 'List %s', __dn('phkapa', 'Ticket', 'Tickets', 2)), array('action' => 'index')); ?> </li>
                <?php
                // parent ticket must be on workflow 4 or 5 ( Verify or Closed )
                if ($ticket['Ticket']['workflow_id'] > 3) :
                    ?>
                    <li><?php echo $this->Html->link(__d('phkapa', 'Open new related ticket'), array('controller' => 'register', 'action' => 'add', $ticket['Ticket']['id'])); ?></li>
                <?php endif; ?>
                <?php if ($editable): ?>
                    <li> <?php echo $this->Html->link(__d('phkapa', 'Edit'), array('controller' => $controller, 'action' => $action, $ticket['Ticket']['id'])); ?></li>

                <?php endif ?>
                    <!--li class="list-group-item"><?php //echo $this->Html->link(__d('phkapa', 'Open Report'), array('action' => 'pdf', $ticket['Ticket']['id'],'ext'=>'pdf'), array('target'=>'_blank','class' => '')); ?> </li-->
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
                    ?>><?php echo __d('phkapa', 'Workflow'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                    ?>>
                            <?php echo $ticket['Workflow']['name']; ?>
                        &nbsp;
                    </dd>
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
                            ?>><?php echo __d('phkapa', 'Approved'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
                            <?php echo $this->Utils->yesOrNo($ticket['Ticket']['approved']); ?>
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
                            ?>><?php echo __d('phkapa', 'Close Date'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
                            <?php
                            if ($ticket['Ticket']['close_date']) {
                                echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['close_date']);
                            }
                            ?>
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
            <a href="#" id="toggle-related-records"><?php echo __d('phkapa', 'Related') . ' - ' . __dn('phkapa', 'Action', 'Actions', 2) . ' (' . count($ticket['Action']) . ')' . ' - ' . __dn('phkapa', 'Ticket', 'Tickets', 2) . ' (' . count($ticket['Children']) . ')'; ?></a>
        </h2>
        <div class="block ui-widget-content" id="related-records">
            <?php if (!empty($ticket['Action'])): ?>
                <div class="related">
                    <h3><?php echo __dn('phkapa', 'Action', 'Actions', 2); ?></h3>

                    <table cellpadding = "0" cellspacing = "0">
                        <thead  class="ui-state-default">
                            <tr>
                                <th><?php echo __d('phkapa', 'Id'); ?></th>

                                <th><?php echo __d('phkapa', 'Action Type'); ?></th>
                                <th><?php echo __d('phkapa', 'Description'); ?></th>
                                <th><?php echo __d('phkapa', 'Deadline'); ?></th>
                                <th><?php echo __d('phkapa', 'Closed'); ?></th>
                                <th><?php echo __d('phkapa', 'Close Date'); ?></th>
                                <th><?php echo __d('phkapa', 'Effectiveness'); ?></th>
                                <th><?php echo __d('phkapa', 'Effectiveness Notes'); ?></th>
                                <th><?php echo __d('phkapa', 'Modified'); ?></th>
                                <th><?php echo __d('phkapa', 'Created'); ?></th>

                            </tr>
                        </thead>
                        <?php
                        $i = 0;
                        foreach ($ticket['Action'] as $action):
                            $class = null;
                            if ($i++ % 2 == 0) {
                                $class = ' class="altrow"';
                            }
                            //debug($action);
                            ?>
                            <tr<?php echo $class; ?>>
                                <td><?php echo $action['id']; ?></td>

                                <td><?php echo $action['ActionType']['name']; ?></td>
                                <td><?php echo $action['description']; ?></td>
                                <td><?php echo $action['deadline'] . ' ' . __d('phkapa', 'Days'); ?></td>
                                <td><?php echo $this->Utils->yesOrNo($action['closed']); ?></td>
                                <td class="nowrap"><?php
                    if ($action['close_date'] != '')
                        echo $this->Time->format(Configure::read('dateFormatSimple'), $action['close_date']);
                            ?></td>
                                <td><?php
                            if (isset($action['ActionEffectiveness']['name']))
                                echo $action['ActionEffectiveness']['name'];
                            ?></td>
                                <td><?php echo $action['effectiveness_notes']; ?></td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $action['modified']); ?></td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $action['created']); ?></td>

                            </tr>
                        <?php endforeach; ?>
                    </table>



                </div>
            <?php endif; ?>    

            <?php if (!empty($ticket['Children'])): ?>
                <div class="related">
                    <h3><?php echo __d('phkapa', 'Related Tickets'); ?></h3>

                    <table cellpadding = "0" cellspacing = "0">
                        <thead  class="ui-state-default">
                            <tr>
                                <th><?php echo __d('phkapa', 'Id'); ?></th>
                                <th><?php echo __d('phkapa', 'Priority'); ?></th>
                                <th><?php echo __d('phkapa', 'Origin Date'); ?></th>
                                <th><?php echo __d('phkapa', 'Type'); ?></th>
                                <th><?php echo __d('phkapa', 'Origin'); ?></th>
                                <th><?php echo __d('phkapa', 'Process'); ?></th>
                                <th><?php echo __d('phkapa', 'Category'); ?></th>
                                <th><?php echo __d('phkapa', 'Description'); ?></th>
                                <th><?php echo __d('phkapa', 'Created'); ?></th>
                                <th><?php echo __d('phkapa', 'Workflow'); ?></th>
                                <th><?php echo __dn('phkapa', 'Action', 'Actions', 2); ?></th>

                            </tr>
                        </thead>
                        <?php
                        $i = 0;
                        foreach ($ticket['Children'] as $children):
                            //debug($children);
                            $class = null;
                            if ($i++ % 2 == 0) {
                                $class = ' class="altrow"';
                            }
                            $editable = false;
                            $controller = null;
                            $action = null;
                            if ($children['Workflow']['id'] < 4) {
                                $editable = true;
                                switch ($children['Workflow']['id']) {
                                    case 1:
                                        $controller = 'register';
                                        $action = 'edit';
                                        break;
                                    case 2:
                                        $controller = 'review';
                                        $action = 'edit';
                                        break;
                                    case 3:
                                        $controller = 'plan';
                                        $action = 'edit';
                                        break;
                                    case 4:
                                        $controller = 'verify';
                                        $action = 'view';
                                        break;
                                }
                            }
                            ?>
                            <tr<?php echo $class; ?>>
                                <td><?php echo $children['id']; ?>&nbsp;</td>
                                <td><?php echo $children['Priority']['name']; ?></td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $children['origin_date']); ?>&nbsp;</td>
                                <td class="nowrap"><?php echo $children['Type']['name']; ?></td>
                                <td><?php echo $children['Origin']['name']; ?></td>
                                <td class="nowrap"><?php echo $children['Process']['name']; ?></td>
                                <td><?php echo $children['Category']['name']; ?></td>
                                <td><?php echo $children['description']; ?>&nbsp;</td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $children['created']); ?>&nbsp;</td>
                                <td><?php echo $children['Workflow']['name']; ?></td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__d('phkapa', 'View'), array('action' => 'view', $children['id'])); ?>
                                    <?php if ($editable): ?>
                                        <?php echo ' | ' . $this->Html->link(__d('phkapa', 'Edit'), array('controller' => $controller, 'action' => $action, $ticket['Ticket']['id'])); ?>

                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php //echo '<tfoot class=\'dark\'>'.$tableHeaders.'</tfoot>';    ?>    </table>



                </div>
            <?php endif; ?>
        </div>
    </div>

</div>
<div class="clear"></div>
