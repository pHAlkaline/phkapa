<?php $this->html->script('Phkapa.register_add', false); ?>
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
                        echo $this->Html->link(__d('phkapa', 'Send %s', __d('phkapa', 'Plan')), array('action' => 'send', $ticket['Ticket']['id']), array('confirm' => __d('phkapa', 'Are you sure you want to send # %s?', $ticket['Ticket']['id'])));
                        ?>  
                    </li>
                <?php endif; ?>
                <?php if ($closeOk) : ?>

                    <li>
                        <?php
                        echo $this->Html->link(__d('phkapa', 'Close %s', __d('phkapa', 'Ticket')), array('action' => 'close', $ticket['Ticket']['id']), array('confirm' => __d('phkapa', 'Are you sure you want to close # %s?', $ticket['Ticket']['id'])));
                        ?>  
                    </li>
                <?php endif; ?>
                <li><?php echo $this->Html->link(__d('phkapa', 'List %s', __dn('phkapa', 'Ticket', 'Tickets', 2)), array('action' => 'index')); ?> </li>

            </ul>

        </div>

    </div>
    <div id="tabs">
        <?php
        $countComment = null;
        if (isset($ticket['Comment'])) {
            $countComment = ' (' . count($ticket['Comment']) . ')';
        }
        $countAttachment = null;
        if (isset($ticket['Attachment'])) {
            $countAttachment = ' (' . count($ticket['Attachment']) . ')';
        }
        ?>
        <ul>
            <li><a href="#tabs-details"><?php echo __dn('phkapa', 'Detail', 'Details', 2); ?></a></li>
            <li><a href="#tabs-feedback"><?php echo __dn('phkapa', 'Comment', 'Comments', 2) . $countComment; ?></a></li>
            <li><a href="#tabs-attachment"><?php echo __dn('phkapa', 'Attachment', 'Attachments', 2) . $countAttachment; ?></a></li>
            

        </ul>
        <div id="tabs-details">

            <div class="tickets view">
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
            <div class="tickets form" >
                <?php echo $this->Form->create(); ?>
                <fieldset class="ui-corner-all ui-widget-content" >
                    <legend><?php echo __d('phkapa', 'Record %s', __d('phkapa', 'Review')); ?></legend>
                    <?php
                    echo $this->Form->input('id');
                    echo $this->Form->hidden('process_change');

                    echo $this->Form->input('origin_date', array('label' => __d('phkapa', 'Origin Date'), 'empty' => __d('phkapa', '(choose one)'), 'dateFormat' => 'DMY', 'maxYear' => date('Y'), 'minYear' => date('Y') - 3, 'maxYear' => date('Y')));
                    echo $this->Form->input('type_id', array('label' => __d('phkapa', 'Type'), 'empty' => __d('phkapa', '(choose one)')));
                    echo $this->Form->input('origin_id', array('label' => __d('phkapa', 'Origin'), 'empty' => __d('phkapa', '(choose one)')));
                    echo $this->Form->input('process_id', array('label' => __d('phkapa', 'Process'), 'empty' => __d('phkapa', '(choose one)'), 'after' =>
                        $this->html->image("loading.gif", array("id" => "LoadProcessData", "alt" => __d('phkapa', "Loading process data"), "style" => "padding-left:10px;display:none;")), "#",
                        array('escape' => false)
                    ));
                    ?>
                    <div id='ProcessData'>
                        <?php
                        echo $this->Form->input('activity_id', array('label' => __d('phkapa', 'Activity'), 'empty' => __d('phkapa', '(choose one)')));
                        echo $this->Form->input('category_id', array('label' => __d('phkapa', 'Category'), 'empty' => __d('phkapa', '(choose one)')));
                        ?>
                    </div>
                    <?php
                    echo $this->Form->input('supplier_id', array('label' => __d('phkapa', 'Supplier'), 'empty' => __d('phkapa', '(choose one)')));
                    echo $this->Form->input('description', array('label' => __d('phkapa', 'Description')));
                    echo "<br/>";
                    echo $this->Form->input('priority_id', array('label' => __d('phkapa', 'Priority'), 'empty' => __d('phkapa', '(choose one)')));
                    echo $this->Form->input('safety_id', array('label' => __d('phkapa', 'Safety'), 'empty' => __d('phkapa', '(choose one)')));
                    if (isset($this->request->data['Ticket']['ticket_parent'])) :
                        echo "<hr/>";
                        echo $this->Form->input('ticket_parent', array('min' => '0', 'label' => __d('phkapa', 'Ticket Parent')));

                    endif;
                    ?>
                    <hr/>
                    <?php
                    $results = array('' => __d('phkapa', '(choose one)'), '0' => __d('phkapa', 'No'), '1' => __d('phkapa', 'Yes'));
                    echo $this->Form->input('approved', array('label' => __d('phkapa', 'Approved')));
                    //echo $this->Form->input('approved', array('label' => __d('phkapa', 'Aproved')));
                    echo $this->Form->input('review_notes', array('label' => __d('phkapa', 'Notes')));
                    echo $this->Form->submit(__d('phkapa', 'Submit'));
                    ?>
                </fieldset>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
        <div id="tabs-feedback">
            <?php
            if (CakePlugin::loaded('Feedback')) {
                ?>
                <div>
                    <?php echo $this->Comments->display_for($ticket, array('model' => 'Phkapa.Ticket')); ?>
                </div>

            <?php } else { ?>
                <div>
                    <?php
                    echo $this->element('pluginNotFound');
                    ?>
                </div>

            <?php } ?>
        </div>
        <div id="tabs-attachment">
            <?php
            if (CakePlugin::loaded('Attachment')) {
                ?>


                <div class="related">
                    <?php echo $this->Attachments->display_for($ticket, array('model' => 'Phkapa.Ticket')); ?>
                </div>




            <?php } else { ?>


                <div class="related">
                    <?php
                    echo $this->element('pluginNotFound');
                    ?>
                </div>




            <?php } ?> </div>
    </div>


</div>


