<h2 id="page-heading"><?php echo __d('phkapa', 'Plan'); ?>:<?php echo __d('phkapa', 'List %s', __dn('phkapa', 'Ticket', 'Tickets', 2)); ?></h2>
<div class="grid_16 actionsContainer">
    <?php echo $this->element('searchBox'); ?>

    <?php if (!empty($tickets)) {
        ?>
        <table cellpadding="0" cellspacing="0">
            <?php
            $tableHeaders = $this->html->tableHeaders(array(
                $this->Paginator->sort('id', __d('phkapa', 'Id')),
                $this->Paginator->sort('Priority.order', __d('phkapa', 'Priority')),
                $this->Paginator->sort('Safety.order', __d('phkapa', 'Safety')),
                $this->Paginator->sort('origin_date', __d('phkapa', 'Origin Date')),
                $this->Paginator->sort('Type.name', __d('phkapa', 'Type')),
                $this->Paginator->sort('Origin.name', __d('phkapa', 'Origin')),
                $this->Paginator->sort('Process.name', __d('phkapa', 'Process')),
                //$this->Paginator->sort('Category.name', __d('phkapa', 'Category')),
                $this->Paginator->sort('Activity.name', __d('phkapa', 'Activity')),
                $this->Paginator->sort('product',__d('phkapa','Product')),
                __d('phkapa', 'Description'),
                //$this->Paginator->sort('created', __d('phkapa', 'Created')),
                //$this->Paginator->sort('modified'),
                __dn('phkapa', 'Action', 'Actions', 2),
                ''));
            echo '<thead class="ui-state-default"' . $tableHeaders . '</thead>';
            ?>

            <?php
            $i = 0;
            foreach ($tickets as $ticket):
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                $hasCause = true;
                $openActions = FALSE;
                // action ( send, close ) show/hide
                $sendOk = true;
                $closeOk = true;
                $verificationCount = 0;
                $hasFlag = false;
                $showActions = true;


                // No cause 
                if ($ticket['Ticket']['cause_id'] == null) {
                    $hasCause = false;
                    $sendOk = false;
                    $closeOk = false;
                }

                // Has Cause but no actions
                if ($hasCause && isset($ticket['Action']) && count($ticket['Action']) == 0) {
                    $sendOk = false;
                    $closeOk = true;
                }

                // Has Cause and actions
                if ($hasCause && isset($ticket['Action']) && count($ticket['Action']) > 0) {

                    foreach ($ticket['Action'] as $action):

                        // Has open actions
                        if ($action['closed'] == 0) {

                            $sendOk = false;
                            $closeOk = false;
                            $openActions = true;
                        }
                        // Has verification type actions
                        if ($action['ActionType']['verification'] == '1') {

                            $verificationCount++;
                        }

                    endforeach;

                    //Has Cause , no open actions, has actions need verifications
                    if (!$openActions && $verificationCount > 0) {

                        $sendOk = true;
                        $closeOk = false;
                    }

                    //Has Cause , no open actions, no actions need verifications
                    if (!$openActions && $verificationCount == 0) {

                        $sendOk = false;
                        $closeOk = true;
                    }
                }



                $flag = '';
                $flagMessage = '';

                if ($ticket['Ticket']['cause_id'] && isset($ticket['Action']) && count($ticket['Action']) > 0) {

                    foreach ($ticket['Action'] as $action):
                        $dayDescription = ($action['deadline'] == 1) ? ' day' : ' days';

                        if ($action['closed'] == 0 && !$this->Time->wasWithinLast($action['deadline'] . $dayDescription, $action['created'])) {
                            $hasFlag = true;
                            $flag = "red_flag_action.png";
                            $flagMessage = __d('phkapa', 'Action deadline expired!!!');
                        }


                    endforeach;

                    /* foreach ($ticket['Action'] as $action):
                      if ($action['ActionType']['verification'] == 1)
                      $verificationCount++;
                      endforeach; */
                } else {
                    if (!$this->Time->wasWithinLast('2 days', $ticket['Ticket']['created'])) {
                        $hasFlag = true;
                        if (!$ticket['Ticket']['cause_id']) {
                            $flagMessage = __d('phkapa', 'No cause!!!');
                            $flag = "purple_flag.png";
                        } else {
                            $flagMessage = __d('phkapa', 'No plan!!!');
                            $flag = "yellow_flag.png";
                        }
                    }
                }
                /* if ($verificationCount == 0) {
                  $sendOk = false;
                  $hasFlag = true;
                  } */
                ?>
                <tr<?php echo $class; ?>>
                    <td><?php echo $ticket['Ticket']['id']; ?>&nbsp;</td>
                    <td class="nowrap"><?php echo h($ticket['Priority']['name']); ?></td>
                    <td class="nowrap"><?php echo h($ticket['Safety']['name']); ?></td>
                    <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['origin_date']); ?>&nbsp;</td>

                    <td class="nowrap"><?php echo h($ticket['Type']['name']); ?></td>
                    <td ><?php echo h($ticket['Origin']['name']); ?></td>
                    <td class="nowrap"><?php echo h($ticket['Process']['name']); ?></td>
                    <!--td><?php //echo $ticket['Category']['name']);  ?></td-->
                    <td><?php echo h($ticket['Activity']['name']); ?></td>
                    <td><?php echo h($ticket['Ticket']['product']);  ?></td>
                    <td><?php
                        echo $this->Text->truncate(
                                $this->Text->autoParagraph(h($ticket['Ticket']['description'])) . $this->Text->autoParagraph(h($ticket['Ticket']['review_notes'])), 60, array(
                            'ellipsis' => '...',
                            'exact' => false
                        ));
                        ?>&nbsp;</td>
                    <!--td class="nowrap"><?php //echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['created']);  ?>&nbsp;</td-->


                    <td class="actions">
                        <?php echo $this->Html->link(__d('phkapa', 'Edit'), array('action' => 'edit', $ticket['Ticket']['id'])); ?>
                        <?php
                        if ($sendOk) {
                            echo ' | ' . $this->Html->link(__d('phkapa', 'Verify'), array('action' => 'send', $ticket['Ticket']['id']), array('confirm' => __d('phkapa', 'Are you sure you want to send # %s?', $ticket['Ticket']['id'])));
                        }

                        if ($closeOk) {
                            echo ' | ' . $this->Html->link(__d('phkapa', 'Close'), array('action' => 'close', $ticket['Ticket']['id']), array('confirm' => __d('phkapa', 'Are you sure you want to close # %s?', $ticket['Ticket']['id'])));
                        }
                        ?>

                    </td>
                    <td><?php
                        if ($hasFlag)
                            echo $this->Html->image($flag, array('alt' => $flagMessage, 'title' => $flagMessage, 'style' => 'vertical-align: middle;cursor:help;'));
                        ?></td>
                </tr>
            <?php endforeach; ?>
            <?php //echo '<tfoot class=\'dark\'>'.$tableHeaders.'</tfoot>';    ?>    </table>

        <p class="paging">
            <?php
            echo $this->Paginator->counter(array(
                'format' => __d('phkapa', 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
            ));
            ?>	</p>

        <div class="paging">
            <?php echo $this->Paginator->prev('<< ' . __d('phkapa', 'Previous'), array(), null, array('class' => 'disabled')); ?>
            | <?php echo $this->Paginator->numbers(); ?>
            | <?php echo $this->Paginator->Next(__d('phkapa', 'Next') . ' >>', array(), null, array('class' => 'disabled')); ?>
        </div>
        <?php
    } else {
        echo __d('phkapa', 'No records found!!!');
    }
    ?>
</div>
<div class="clear"></div>

