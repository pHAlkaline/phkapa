<h2 id="page-heading"><?php echo __d('phkapa','View %s', __d('phkapa','Customer')); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">

        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa','Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">
            <h5><?php echo __dn('phkapa','Customer','Customers',2); ?></h5>
            <ul class="menu">				
                <li><?php echo $this->Html->link(__d('phkapa','Edit %s', __d('phkapa','Customer')), array('action' => 'edit', $customer['Customer']['id'])); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Delete %s', __d('phkapa','Customer')), array('action' => 'delete', $customer['Customer']['id']), array('confirm'=> __d('phkapa','Are you sure you want to delete # %s?', $customer['Customer']['name']))); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Customer','Customers',2)), array('action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Customer')), array('action' => 'add')); ?> </li>
            </ul>			

            <h5><?php echo __dn('phkapa','Ticket','Tickets',2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Ticket','Tickets',2)), array('controller' => 'tickets', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Ticket')), array('controller' => 'tickets', 'action' => 'add')); ?> </li>
            </ul>


        </div>

    </div>



    <div class="box ui-corner-all ui-widget-content" >
        <div class="customers view">

            <div class="block">
                <dl><?php $i = 0;
$class = ' class="altrow"';
?>
                    <dt<?php if ($i % 2 == 0)
                        echo $class;
?>><?php echo __d('phkapa','Id'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class;
?>>
                        <?php echo $customer['Customer']['id']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                            echo $class;
                        ?>><?php echo __d('phkapa','Name'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                                echo $class;
                        ?>>
                        <?php echo $customer['Customer']['name']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                            echo $class;
                        ?>><?php echo __d('phkapa','Active'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class;
                        ?>>
                            <?php echo $this->Utils->yesOrNo($customer['Customer']['active']); ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class;
                            ?>><?php echo __d('phkapa','Created'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
<?php echo $this->Time->format(Configure::read('dateFormat'), $customer['Customer']['created']); ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
    echo $class;
?>><?php echo __d('phkapa','Modified'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
    echo $class;
?>>
<?php echo $this->Time->format(Configure::read('dateFormat'), $customer['Customer']['modified']); ?>
                        &nbsp;
                    </dd>
                </dl>
            </div>
        </div>
    </div>



</div>
<div class="clear"></div>
