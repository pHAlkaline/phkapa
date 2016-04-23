<?php $ticket['Ticket'] = $ticket['Revision_Ticket']; ?>
<h2 id="page-heading"><?php echo __d('phkapa', 'View %s', __d('phkapa', 'Ticket')) . ' ' . __dn('phkapa', 'Revision', 'Revisions', 1); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">

        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa', 'Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">
            <h5><?php echo __dn('phkapa', 'Ticket', 'Tickets', 2); ?></h5>
            <ul class="menu">

                <li><?php echo $this->Html->link(__d('phkapa', 'View %s', __d('phkapa', 'Ticket')), array('action' => 'view', $ticket['Ticket']['id'])); ?> </li>
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
                    ?>><?php echo __d('phkapa', 'Version Id'); ?></dt>
                    <dd<?php
                    if ($i++ % 2 == 0)
                        echo $class;
                    ?>>
                            <?php echo $ticket['Ticket']['version_id']; ?>
                        &nbsp;
                    </dd>  
                    <dt<?php
                    if ($i % 2 == 0)
                        echo $class;
                    ?>><?php echo __d('phkapa', 'Request'); ?></dt>
                    <dd<?php
                    if ($i++ % 2 == 0)
                        echo $class;
                    ?>>
                            <?php echo $ticket['Ticket']['version_request']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                    if ($i % 2 == 0)
                        echo $class;
                    ?>><?php echo __d('phkapa', 'Version Created'); ?></dt>
                    <dd<?php
                    if ($i++ % 2 == 0)
                        echo $class;
                    ?>>
                            <?php if ($ticket['Ticket']['version_created']) : ?>
                                <?php echo $this->Time->format(Configure::read('dateFormat'), $ticket['Ticket']['version_created']); ?>
                            <?php endif; ?>
                        &nbsp;
                    </dd>
                    <hr/>
                    <dt<?php
                    if ($i % 2 == 0)
                        echo $class;
                    ?>><?php echo __d('phkapa', 'Id'); ?></dt>
                    <dd<?php
                    if ($i++ % 2 == 0)
                        echo $class;
                    ?>>
                            <?php echo $this->Html->link($ticket['Ticket']['id'], array('controller' => 'tickets', 'action' => 'view', $ticket['Ticket']['id'])); ?>
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
                    ?>><?php echo __d('phkapa', 'Product'); ?></dt>
                    <dd<?php
                    if ($i++ % 2 == 0)
                        echo $class;
                    ?>>
                            <?php echo $ticket['Ticket']['product']; ?>
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
                    ?>><?php echo __d('phkapa', 'Customer'); ?></dt>
                    <dd<?php
                    if ($i++ % 2 == 0)
                        echo $class;
                    ?>>
                            <?php echo $this->Html->link($ticket['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $ticket['Customer']['id'])); ?>
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



</div>
<div class="clear"></div>
