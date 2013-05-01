<h2 id="page-heading"><?php echo __d('phkapa','Register'); ?>:<?php echo __d('phkapa','View %s', __d('phkapa','Ticket')); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">
        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa','Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">
            <h5><?php echo __dn('phkapa','Ticket','Tickets',2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa','Send %s', __d('phkapa','Ticket')), array('action' => 'send', $ticket['Ticket']['id']), null, __d('phkapa','Are you sure you want to send # %s?', $ticket['Ticket']['id'])); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Edit %s', __d('phkapa','Ticket')), array('action' => 'edit', $ticket['Ticket']['id'])); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Delete %s', __d('phkapa','Ticket')), array('action' => 'delete', $ticket['Ticket']['id']), null, __d('phkapa','Are you sure you want to delete # %s?', $ticket['Ticket']['id'])); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Ticket','Tickets',2)), array('action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Ticket')), array('action' => 'add')); ?> </li>
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
?>><?php echo __d('phkapa','Id'); ?></dt>
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
                            ?>><?php echo __d('phkapa','Ticket Parent'); ?></dt>
                        <dd<?php
                            if ($i++ % 2 == 0)
                                echo $class;
                            ?>>
                        <?php
                        echo $this->Html->link($ticket['Ticket']['ticket_parent'] . ' ' . $this->Html->image("accept.png", array("alt" => __d('phkapa',"See ticket parent data"), "style" => "padding-left:100px;")) . ' ' . __d('phkapa',"See ticket parent data"), array('controller' => 'query', 'action' => 'view', $ticket['Ticket']['ticket_parent']), array('escape' => false));
                        ?>
                            &nbsp;
                        </dd>
                    <?php } ?>
                    <dt<?php
                    if ($i % 2 == 0)
                        echo $class;
                    ?>><?php echo __d('phkapa','Registar'); ?></dt>
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
                    ?>><?php echo __d('phkapa','Priority'); ?></dt>
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
                    ?>><?php echo __d('phkapa','Origin Date'); ?></dt>
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
                        ?>><?php echo __d('phkapa','Type'); ?></dt>
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
?>><?php echo __d('phkapa','Origin'); ?></dt>
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
                    ?>><?php echo __d('phkapa','Process'); ?></dt>
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
                    ?>><?php echo __d('phkapa','Activity'); ?></dt>
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
                    ?>><?php echo __d('phkapa','Category'); ?></dt>
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
?>><?php echo __d('phkapa','Supplier'); ?></dt>
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
?>><?php echo __d('phkapa','Description'); ?></dt>
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
?>><?php echo __d('phkapa','Modified'); ?></dt>
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
?>><?php echo __d('phkapa','Created'); ?></dt>
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
