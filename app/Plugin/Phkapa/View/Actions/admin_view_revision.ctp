<?php $action['Action'] = $action['Revision_Action']; ?>
<h2 id="page-heading"><?php
    echo __d('phkapa', 'View %s', __d('phkapa', 'Action')) . ' ' . __dn('phkapa', 'Revision', 'Revisions', 1);
    ;
    ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">

        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa', 'Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">
            <h5><?php echo __dn('phkapa', 'Ticket', 'Tickets', 2); ?></h5>
            <ul class="menu">

                <li><?php echo $this->Html->link(__d('phkapa', 'View %s', __d('phkapa', 'Action')), array('action' => 'view', $action['Action']['id'])); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa', 'List %s', __dn('phkapa', 'Action', 'Actions', 2)), array('action' => 'index')); ?> </li>
            </ul>

        </div>


    </div>
    <div class="box ui-corner-all ui-widget-content" >
        <div class="ticket-actions view">

            <div class="block">
                <dl><?php
                    $i = 0;
                    $class = ' class="altrow"';
                    ?>
                    <dt<?php
                    if ($i % 2 == 0)
                        echo $class;
                    ?>><?php echo __d('phkapa', 'Version'); ?></dt>
                    <dd<?php
                    if ($i++ % 2 == 0)
                        echo $class;
                    ?>>
<?php echo $action['Action']['version_id']; ?>
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
<?php echo $action['Action']['version_request']; ?>
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
                            <?php if ($action['Action']['version_created']) : ?>
                                <?php echo $this->Time->format(Configure::read('dateFormat'), $action['Action']['version_created']); ?>
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
<?php echo $action['Action']['id']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                    if ($i % 2 == 0)
                        echo $class;
                    ?>><?php echo __d('phkapa', 'Ticket'); ?></dt>
                    <dd<?php
                    if ($i++ % 2 == 0)
                        echo $class;
                    ?>>
<?php echo $this->Html->link($action['Ticket']['id'], array('controller' => 'tickets', 'action' => 'view', $action['Ticket']['id'])); ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                    if ($i % 2 == 0)
                        echo $class;
                    ?>><?php echo __d('phkapa', 'Action Type'); ?></dt>
                    <dd<?php
                    if ($i++ % 2 == 0)
                        echo $class;
                    ?>>
<?php echo h($action['ActionType']['name']); ?>
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
<?php echo $this->Text->autoParagraph(h($action['Action']['description'])); ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                    if ($i % 2 == 0)
                        echo $class;
                    ?>><?php echo __d('phkapa', 'Deadline'); ?></dt>
                    <dd<?php
                    if ($i++ % 2 == 0)
                        echo $class;
                    ?>>
<?php echo $action['Action']['deadline'] . ' ' . __d('phkapa', 'Days'); ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                    if ($i % 2 == 0)
                        echo $class;
                    ?>><?php echo __d('phkapa', 'Closed'); ?></dt>
                    <dd<?php
                    if ($i++ % 2 == 0)
                        echo $class;
                    ?>>
<?php echo $this->Utils->yesOrNo($action['Action']['closed']); ?>
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
<?php echo $action['CloseUser']['name']; ?>
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
                            if ($action['Action']['close_date'] != '')
                                echo $this->Time->format(Configure::read('dateFormatSimple'), $action['Action']['close_date']);
                            ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                    if ($i % 2 == 0)
                        echo $class;
                    ?>><?php echo __d('phkapa', 'Effectiveness'); ?></dt>
                    <dd<?php
                    if ($i++ % 2 == 0)
                        echo $class;
                    ?>>
<?php echo h($action['ActionEffectiveness']['name']); ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                    if ($i % 2 == 0)
                        echo $class;
                    ?>><?php echo __d('phkapa', 'Verified By'); ?></dt>
                    <dd<?php
                    if ($i++ % 2 == 0)
                        echo $class;
                    ?>>
<?php echo h($action['VerifyUser']['name']); ?>
                        &nbsp;
                    </dd>
                    <dt<?php
                    if ($i % 2 == 0)
                        echo $class;
                    ?>><?php echo __d('phkapa', 'Effectiveness Notes'); ?></dt>
                    <dd<?php
                    if ($i++ % 2 == 0)
                        echo $class;
                    ?>>
<?php echo $this->Text->autoParagraph(h($action['Action']['effectiveness_notes'])); ?>
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
<?php echo h($action['ModifiedUser']['name']); ?>
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
<?php echo $this->Time->format(Configure::read('dateFormat'), $action['Action']['modified']); ?>
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
<?php echo $this->Time->format(Configure::read('dateFormat'), $action['Action']['created']); ?>
                        &nbsp;
                    </dd>
                </dl>
            </div>
        </div>
    </div>

</div>
<div class="clear"></div>
