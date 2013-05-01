<?php
$sendOk = false;
$closeOk = false;

if ($ticket['Ticket']['approved'] == 1) {
    
    $sendOk = true;
}
if ($ticket['Ticket']['approved'] == 0) {
    $closeOk = true;
    
}
if ($ticket['Ticket']['approved'] === null) {
    
    $sendOk = false;
    $closeOk = false;
}
//debug($ticket['Ticket']['approved']);
?>
<h2 id="page-heading"><?php echo __d('phkapa', 'Review'); ?> : <?php echo __d('phkapa', 'Ticket'); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">
        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa', 'Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">
            <h5><?php echo __dn('phkapa', 'Ticket', 'Tickets', 2); ?></h5>
            <ul class="menu">
                <?php if ($sendOk) : ?>

                    <li>
                        <?php
                        echo $this->Html->link(__d('phkapa', 'Send %s', __d('phkapa', 'Ticket')), array('action' => 'send', $ticket['Ticket']['id']), null, __d('phkapa', 'Are you sure you want to send # %s?', $ticket['Ticket']['id']));
                        ?>  
                    </li>
                <?php endif; ?>
                <?php if ($closeOk) : ?>

                    <li>
                        <?php
                        echo $this->Html->link(__d('phkapa', 'Close %s', __d('phkapa', 'Ticket')), array('action' => 'close', $ticket['Ticket']['id']), null, __d('phkapa', 'Are you sure you want to close # %s?', $ticket['Ticket']['id']));
                        ?>  
                    </li>
                <?php endif; ?>
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
                            <?php echo $ticket['Ticket']['description']; ?>
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
            <legend><?php echo __d('phkapa', 'Record %s', __d('phkapa', 'Review')); ?></legend>
            <?php
            echo $this->Form->input('id');
            echo $this->Form->input('priority_id', array('label' => __d('phkapa','Priority'),'empty' => __d('phkapa','(choose one)')));
            
            $results = array('' => __d('phkapa','(choose one)'), '0' => __d('phkapa','No'), '1' => __d('phkapa','Yes'));
            echo $this->Form->input('approved', array('label'=> __d('phkapa', 'Approved')));
           //echo $this->Form->input('approved', array('label' => __d('phkapa', 'Aproved')));
            echo $this->Form->input('review_notes', array('label' => __d('phkapa', 'Notes')));
            echo $this->Form->submit(__d('phkapa', 'Submit'));
            ?>
        </fieldset>
        <?php echo $this->Form->end(); ?>
    </div>

</div>
<div class="clear"></div>
