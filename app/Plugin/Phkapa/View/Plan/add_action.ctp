<h2 class="grid_16" id="page-heading"><?php echo __d('phkapa', 'Plan'); ?>:<?php echo __d('phkapa', 'Add %s', __d('phkapa', 'Action')); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">		
        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa', 'Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">			
            <h5><?php echo __dn('phkapa', 'Action', 'Actions', 2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa', 'Edit %s', __d('phkapa', 'Ticket')), array('action' => 'edit', $ticket['Ticket']['id'])); ?></li>
            </ul>

            <h5><?php echo __dn('phkapa', 'Ticket', 'Tickets', 2); ?></h5>
            <ul class="menu">
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
<?php echo $this->Text->autoParagraph($ticket['Ticket']['description']) . '<br/>' . $this->Text->autoParagraph($ticket['Ticket']['review_notes']); ?>
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
  
    <div class="actions form">
<?php //echo $this->Form->create('Action', array('url' => array('controller' => 'plan', 'action' => 'add_action')));  ?>
<?php echo $this->Form->create('Action'); ?>

        <fieldset class="ui-corner-all ui-widget-content" >
            <legend><?php echo __d('phkapa', 'Record') . ' ' . __d('phkapa', 'Action'); ?></legend>
<?php
echo $this->Form->hidden('ticket_id', array('label' => __d('phkapa', 'Ticket'), 'value' => $ticket['Ticket']['id']));
echo $this->Form->input('action_type_id', array('label' => __d('phkapa', 'Action Type'), 'empty' => __d('phkapa', '(choose one)')));
echo $this->Form->input('description', array('label' => __d('phkapa', 'Description')));
echo $this->Form->input('deadline', array('min' => '0', 'label' => __d('phkapa', 'Deadline') . ' (' . __d('phkapa', 'Days') . ' )'));
echo $this->Form->input('closed', array('label' => __d('phkapa', 'Closed')));
?>
        </fieldset>
<?php echo $this->Form->end(__d('phkapa', 'Submit')); ?>
    </div>
     <div class="clear"></div>
    <?php
    if (CakePlugin::loaded('Feedback')) {
        ?>
        <div class="ui-corner-all ui-widget" id="related-comment">
            <h2>
                <a href="#" id="toggle-related-comments"><?php echo __d('phkapa', 'Related') . ' - ' . __dn('phkapa', 'Comment', 'Comments', 2) . ' (' . count($ticket['Comment']) . ')'; ?></a>
            </h2>
            <div class="block ui-widget-content" id="related-records">
                <div class="related">
                <?php echo $this->Comments->display_for($ticket, array('showForm' => false, 'model' => 'Phkapa.Ticket')); ?>
                </div>
            </div>


        </div>
        <?php } else { ?>
        <div class="ui-corner-all ui-widget" id="related-comment">
            <h2>
                <a href="#" id="toggle-related-comments"><?php echo __d('phkapa', 'Related') . ' - ' . __dn('phkapa', 'Comment', 'Comments', 2); ?></a>
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
</div>
<div class="clear"></div>
