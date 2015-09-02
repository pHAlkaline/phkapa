<h2 id="page-heading"><?php echo __d('phkapa', 'View %s', __d('phkapa', 'Ticket')); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">

        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa', 'Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">
            <h5><?php echo __dn('phkapa', 'Ticket', 'Tickets', 2); ?></h5>
            <ul class="menu">

                <li><?php echo $this->Html->link(__d('phkapa', 'Edit %s', __d('phkapa', 'Ticket')), array('action' => 'edit', $ticket['Ticket']['id'])); ?> </li>
                
                <li><?php echo $this->Html->link(__d('phkapa', 'Delete %s', __d('phkapa', 'Ticket')), array('action' => 'delete', $ticket['Ticket']['id']), array('escape' => false,'confirm'=>__d('phkapa', 'Are you sure you want to delete # %s?', $ticket['Ticket']['id']) . ' ' . __d('phkapa', 'Related Child Tickets and actions will also be deleted!!'))); ?></li>
                <li><?php echo $this->Html->link(__d('phkapa', 'List %s', __dn('phkapa', 'Ticket', 'Tickets', 2)), array('action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Ticket')), array('action' => 'add')); ?> </li>
                <?php
                // parent ticket must be on workflow 4 or 5 ( Verify or Closed ) to be allowed to be closed ou replan
                if ($ticket['Ticket']['workflow_id'] > 3) :
                    ?>
                    <li><?php echo $this->Html->link(__d('phkapa', 'Open new related ticket'), array('action' => 'add', $ticket['Ticket']['id'])); ?></li>
                    
                <?php endif; ?>
                     <li class="list-group-item"><?php echo $this->Html->link(__d('phkapa', 'Open Report'), array('action' => 'print_report', $ticket['Ticket']['id']), array('target'=>'_blank','class' => '')); ?> </li>


            </ul>
            <h5><?php echo __dn('phkapa', 'Option', 'Options', 2); ?></h5>
            <ul class="menu">

                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Priority')), array('controller' => 'priorities', 'action' => 'add')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Safety')), array('controller' => 'safeties', 'action' => 'add')); ?> </li>

                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Type')), array('controller' => 'types', 'action' => 'add')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Origin')), array('controller' => 'origins', 'action' => 'add')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Process')), array('controller' => 'processes', 'action' => 'add')); ?> </li>


                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Activity')), array('controller' => 'activities', 'action' => 'add')); ?> </li>

                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Category')), array('controller' => 'categories', 'action' => 'add')); ?> </li>



                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Supplier')), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Cause')), array('controller' => 'causes', 'action' => 'add')); ?> </li>
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
                                echo $this->Html->link($ticket['Ticket']['ticket_parent'] . ' ' . $this->Html->image("accept.png", array("alt" => __d('phkapa', "See ticket parent data"), "style" => "padding-left:100px;")) . ' ' . __d('phkapa', "See ticket parent data"), array('action' => 'view', $ticket['Ticket']['ticket_parent']), array('escape' => false));
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
                            <?php echo $this->Html->link($ticket['Registar']['name'], array('controller' => 'users', 'action' => 'view', $ticket['Registar']['id'])); ?>
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
                            <?php echo $this->Html->link($ticket['Priority']['name'], array('controller' => 'priorities', 'action' => 'view', $ticket['Priority']['id'])); ?>
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
                            <?php echo $this->Html->link($ticket['Safety']['name'], array('controller' => 'safeties', 'action' => 'view', $ticket['Safety']['id'])); ?>
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
                            <?php echo $this->Html->link($ticket['Type']['name'], array('controller' => 'types', 'action' => 'view', $ticket['Type']['id'])); ?>
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
                            <?php echo $this->Html->link($ticket['Origin']['name'], array('controller' => 'origins', 'action' => 'view', $ticket['Origin']['id'])); ?>
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
                            <?php echo $this->Html->link($ticket['Process']['name'], array('controller' => 'processes', 'action' => 'view', $ticket['Process']['id'])); ?>
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
                            <?php echo $this->Html->link($ticket['Activity']['name'], array('controller' => 'activities', 'action' => 'view', $ticket['Activity']['id'])); ?>
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
                            <?php echo $this->Html->link($ticket['Category']['name'], array('controller' => 'categories', 'action' => 'view', $ticket['Category']['id'])); ?>
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
                            <?php echo $this->Html->link($ticket['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $ticket['Supplier']['id'])); ?>
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
                            <?php echo $this->Text->autoParagraph($ticket['Ticket']['description']) . $this->Text->autoParagraph($ticket['Ticket']['review_notes']); ?>
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
                            <?php echo $this->Html->link($ticket['Cause']['name'], array('controller' => 'causes', 'action' => 'view', $ticket['Cause']['id'])); ?>
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
                            <?php echo $this->Text->autoParagraph($ticket['Ticket']['cause_notes']); ?>
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
                            <?php if ($ticket['Ticket']['close_date']) : ?>
                                <?php echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['close_date']); ?>
                            <?php endif; ?>
                        &nbsp;

                    </dd>
                    <dt<?php
                            if ($i % 2 == 0)
                                echo $class;
                            ?>><?php echo __d('phkapa', 'Closed By'); ?></dt>
                    <dd<?php
                        if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
                            <?php echo $this->Html->link($ticket['CloseUser']['name'], array('controller' => 'users', 'action' => 'view', $ticket['CloseUser']['id'])); ?>
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
                            <?php echo $this->Html->link($ticket['ModifiedUser']['name'], array('controller' => 'users', 'action' => 'view', $ticket['ModifiedUser']['id'])); ?>
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
<div class="clear"></div>
    <?php
    if (CakePlugin::loaded('Feedback')) {
        ?>
        <div class="ui-corner-all ui-widget" id="related-comment">
            <h2>
                <a href="#" id="toggle-related-comments"><?php echo __dn('phkapa', 'Comment', 'Comments', 2) . ' (' . count($ticket['Comment']) . ')'; ?></a>
            </h2>
            <div class="block ui-widget-content" id="related-records">
                <div class="related">
                    <?php echo $this->Comments->display_for($ticket, array('model' => 'Phkapa.Ticket')); ?>
                </div>
            </div>


        </div>
    <?php } else { ?>
        <div class="ui-corner-all ui-widget" id="related-comment">
            <h2>
                <a href="#" id="toggle-related-comments"><?php echo __dn('phkapa', 'Comment', 'Comments', 2); ?></a>
            </h2>
            <div class="block ui-widget-content" id="related-records">
                <div class="related">
                    <?php
                    echo $this->element('pluginNotFound');
                    ?>
                </div>
            </div>


        </div>           
    <?php } ?>
    <div class="ui-corner-all ui-widget" id="related">
        <h2>
            <a href="#" id="toggle-related-records"><?php echo __dn('phkapa', 'Action', 'Actions', 2) . ' (' . count($ticket['Action']) . ')' . ' - ' . __dn('phkapa', 'Ticket', 'Tickets', 2) . ' (' . count($ticket['Children']) . ')'; ?></a>
        </h2>
        <div class="block ui-widget-content" id="related-records">
            <div class="related">
                <h3><?php echo __dn('phkapa', 'Action', 'Actions', 2); ?></h3>
                <?php if (!empty($ticket['Action'])): ?>
                    <table cellpadding = "0" cellspacing = "0">
                        <thead class="ui-state-default"
                               <tr>
                                <th><?php echo __d('phkapa', 'Id'); ?></th>
                                <th><?php echo __d('phkapa', 'Action Type'); ?></th>
                                <th><?php echo __d('phkapa', 'Closed'); ?></th>
                                <th><?php echo __d('phkapa', 'Closed By'); ?></th>
                                <th><?php echo __d('phkapa', 'Close Date'); ?></th>
                                <th><?php echo __d('phkapa', 'Effectiveness'); ?></th>
                                <th><?php echo __d('phkapa', 'Verified By'); ?></th>
                                <th><?php echo __d('phkapa', 'Last Modification By'); ?></th>
                                <th><?php echo __d('phkapa', 'Modified'); ?></th>
                                <th><?php echo __d('phkapa', 'Created'); ?></th>
                                <th class="actions"><?php echo __dn('phkapa', 'Action', 'Actions', 2); ?></th>
                            </tr>
                        </thead>
                        <?php
                        $i = 0;
                        foreach ($ticket['Action'] as $action):
                            $class = null;
                            if ($i++ % 2 == 0) {
                                $class = ' class="altrow"';
                            }
                            ?>
                            <tr<?php echo $class; ?>>
                                <td><?php echo $action['id']; ?></td>
                                <td><?php echo $action['ActionType']['name']; ?></td>
                                <td><?php echo $this->Utils->yesOrNo($action['closed']); ?></td>
                                <td><?php if (isset($action['CloseUser']['name'])) echo $action['CloseUser']['name']; ?></td>
                                <td class="nowrap">
                                    <?php
                                    if ($action['close_date'] != '')
                                        echo $this->Time->format(Configure::read('dateFormatSimple'), $action['close_date']);
                                    ?>
                                </td>
                                
                                <td><?php
                            if (isset($action['ActionEffectiveness']['name']))
                                echo $action['ActionEffectiveness']['name'];
                                    ?></td>
                                <td><?php if (isset($action['VerifyUser']['name'])) echo $action['VerifyUser']['name']; ?></td>
                                <td><?php echo $action['ModifiedUser']['name']; ?></td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $action['modified']); ?></td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $action['created']); ?></td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__d('phkapa', 'View'), array('controller' => 'actions', 'action' => 'view', $action['id'])); ?>
                                    <?php echo ' | ' . $this->Html->link(__d('phkapa', 'Edit'), array('controller' => 'actions', 'action' => 'edit', $action['id'])); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>

                <div class="actions">
                    <ul>
                        <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Action')), array('controller' => 'actions', 'action' => 'add', $ticket['Ticket']['id'])); ?> </li>
                    </ul>
                </div>
            </div>
            
            <div class="related">
                <h3><?php echo __d('phkapa', 'Related Tickets'); ?></h3>
                <?php if (!empty($ticket['Children'])): ?>
                    <table cellpadding = "0" cellspacing = "0">
                        <thead class="ui-state-default"
                               <tr>
                                <th><?php echo __d('phkapa', 'Id'); ?></th>

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
                            $class = null;
                            if ($i++ % 2 == 0) {
                                $class = ' class="altrow"';
                            }
                            ?>
                            <tr<?php echo $class; ?>>
                                <td><?php echo $children['id']; ?>&nbsp;</td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $children['origin_date']); ?>&nbsp;</td>
                                <td class="nowrap"><?php echo $children['Type']['name']; ?></td>
                                <td><?php echo $children['Origin']['name']; ?></td>
                                <td class="nowrap"><?php echo $children['Process']['name']; ?></td>
                                <td><?php echo $children['Category']['name']; ?></td>
                                <td><?php
                        echo $this->Text->truncate(
                                $this->Text->autoParagraph($ticket['Ticket']['description']) . $this->Text->autoParagraph($ticket['Ticket']['review_notes']), 60, array(
                            'ellipsis' => '...',
                            'exact' => false
                        ));
                        ?>&nbsp;</td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $children['created']); ?>&nbsp;</td>

                                <td>
                                    <?php echo $children['Workflow']['name']; ?>
                                </td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__d('phkapa', 'View'), array('action' => 'view', $children['id'])); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php //echo '<tfoot class=\'dark\'>'.$tableHeaders.'</tfoot>';    ?>    </table>
                <?php endif; ?>

                <?php
                // parent ticket must be on workflow 4 or 5 ( Verify or Closed )
                if ($ticket['Ticket']['workflow_id'] > 2) :
                    ?>
                    <div class="actions">
                        <ul>

                            <li><?php echo $this->Html->link(__d('phkapa', 'Open new related ticket'), array('action' => 'add', $ticket['Ticket']['id'])); ?></li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h3><?php echo __dn('phkapa', 'Revision','Revisions',2); ?></h3>
                <?php if (!empty($ticket_revisions)): ?>
                    <table cellpadding = "0" cellspacing = "0">
                        <thead class="ui-state-default"
                               <tr>
                                <th><?php echo __d('phkapa', 'Id'); ?></th>
                                <th><?php echo __d('phkapa', 'Request'); ?></th>
                                <th><?php echo __d('phkapa', 'Workflow'); ?></th>
                                <th><?php echo __d('phkapa', 'Modified'); ?></th>
                                <th><?php echo __d('phkapa', 'Last Modification By'); ?></th>
                                <th><?php echo __dn('phkapa', 'Action', 'Actions', 2); ?></th>

                            </tr>
                        </thead>
                        <?php
                        $i = 0;
                        foreach ($ticket_revisions as $revision):
                            $revision['Ticket']=$revision['Revision_Ticket'];
                            
                            $class = null;
                            if ($i++ % 2 == 0) {
                                $class = ' class="altrow"';
                            }
                            ?>
                            <tr<?php echo $class; ?>>
                                <td><?php echo $revision['Ticket']['version_id']; ?>&nbsp;</td>
                                <td><?php echo $revision['Ticket']['version_request']; ?>&nbsp;</td>
                                
                                <td>
                                    <?php echo $revision['Workflow']['name']; ?>
                                </td>
                                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormat'), $revision['Ticket']['modified']); ?>&nbsp;</td>
                                <td>
                                    <?php echo $revision['ModifiedUser']['name']; ?>
                                </td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__d('phkapa', 'View'), array('action' => 'view_revision', $revision['Ticket']['version_id'], $revision['Ticket']['id'])); ?>
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
