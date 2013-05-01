<h2 id="page-heading"><?php echo __d('phkapa','View %s', __d('phkapa','Action Type')); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">

        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa','Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">
            <h5><?php echo __dn('phkapa','Action Type','Action Types',2); ?></h5>
            <ul class="menu">				
                <li><?php echo $this->Html->link(__d('phkapa','Edit %s', __d('phkapa','Action Type')), array('action' => 'edit', $action_type['ActionType']['id'])); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Delete %s', __d('phkapa','Action Type')), array('action' => 'delete', $action_type['ActionType']['id']), null, __d('phkapa','Are you sure you want to delete # %s?', $action_type['ActionType']['id'])); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Action Type','Action Types',2)), array('action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Action Type')), array('action' => 'add')); ?> </li>
            </ul>			

            <h5><?php echo __dn('phkapa','Action','Actions',2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Action','Actions',2)), array('controller' => 'actions', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Action')), array('controller' => 'actions', 'action' => 'add')); ?> </li>
            </ul>


        </div>

    </div>



    <div class="box ui-corner-all ui-widget-content" >
        <div class="types view">

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
                        <?php echo $action_type['ActionType']['id']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                            echo $class;
                        ?>><?php echo __d('phkapa','Name'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                                echo $class;
                        ?>>
                        <?php echo $action_type['ActionType']['name']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                            echo $class;
                        ?>><?php echo __d('phkapa','Verification'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class;
                        ?>>
                            <?php echo $this->Utils->yesOrNo($action_type['ActionType']['verification']); ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                            echo $class;
                        ?>><?php echo __d('phkapa','Active'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class;
                        ?>>
                            <?php echo $this->Utils->yesOrNo($action_type['ActionType']['active']); ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class;
                            ?>><?php echo __d('phkapa','Created'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class;
                            ?>>
<?php echo $this->Time->format(Configure::read('dateFormat'), $action_type['ActionType']['created']); ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
    echo $class;
?>><?php echo __d('phkapa','Modified'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
    echo $class;
?>>
<?php echo $this->Time->format(Configure::read('dateFormat'), $action_type['ActionType']['modified']); ?>
                        &nbsp;
                    </dd>
                </dl>
            </div>
        </div>
    </div>



</div>
<div class="clear"></div>
