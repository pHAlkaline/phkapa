<h2 id="page-heading"><?php echo __d('phkapa','Verify').':'.__d('phkapa','List %s', __dn('phkapa','Ticket','Tickets',2)); ?></h2>
<div class="grid_16 actionsContainer">
    <?php echo $this->element('searchBox'); ?>
    <?php if (!empty($tickets)) { ?>
        <table cellpadding="0" cellspacing="0">
            <?php
            $tableHeaders = $this->html->tableHeaders(array(
                $this->Paginator->sort('id',__d('phkapa','Id')),
                $this->Paginator->sort('Priority.order', __d('phkapa','Priority')),
                $this->Paginator->sort('Safety.order', __d('phkapa','Safety')),
                $this->Paginator->sort('origin_date',__d('phkapa','Origin Date')),
                $this->Paginator->sort('Type.name', __d('phkapa','Type')),
                $this->Paginator->sort('Origin.name',__d('phkapa','Origin')),
                $this->Paginator->sort('Process.name',__d('phkapa','Process')),
                //$this->Paginator->sort('Category.name',__d('phkapa','Category')),
                $this->Paginator->sort('Activity.name',__d('phkapa','Activity')),
                __d('phkapa','Description'),
                //$this->Paginator->sort('created',__d('phkapa','Created')),
                //$this->Paginator->sort('modified'),
               array(__dn('phkapa','Action','Actions',2)=>array('class'=>'actions'))));
            echo '<thead class="ui-state-default"' . $tableHeaders . '</thead>';
            ?>

            <?php
            $i = 0;
            foreach ($tickets as $ticket):
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                $closeOk = false;
                $closeMessage = '';

                if (isset($ticket['Action']) && count($ticket['Action']) > 0) {
                    $closeOk = true;
                    foreach ($ticket['Action'] as $action):

                        if ($action['ActionType']['verification'] != 0 && ($action['action_effectiveness_id'] == '1' || $action['action_effectiveness_id'] == null)){
                            $closeOk = false;
                        }
                        if ($action['ActionType']['verification'] != 0 && $action['action_effectiveness_id'] != '2') {
                            $closeMessage = __d('phkapa','This ticket has actions that were not effective, please choose cancel if you want replan or create a new related ticket before closing.');
                        }
                    endforeach;
                }
                ?>
                <tr<?php echo $class; ?>>
                    <td><?php echo $ticket['Ticket']['id']; ?>&nbsp;</td>
                    <td class="nowrap"><?php echo $ticket['Priority']['name']; ?></td>
                    <td class="nowrap"><?php echo $ticket['Safety']['name']; ?></td>
                    <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['origin_date']); ?>&nbsp;</td>
                    <td class="nowrap"><?php echo $ticket['Type']['name']; ?></td>
                    <td><?php echo $ticket['Origin']['name']; ?></td>
                    <td class="nowrap"><?php echo $ticket['Process']['name']; ?></td>
                    <!--td><?php //echo $ticket['Category']['name']; ?></td-->
                    <td><?php echo $ticket['Activity']['name']; ?></td>
                    <td><?php
        echo $this->Text->truncate(
                $this->Text->autoParagraph($ticket['Ticket']['description']) . $this->Text->autoParagraph($ticket['Ticket']['review_notes']), 60, array(
            'ellipsis' => '...',
            'exact' => false
        ));
                ?>&nbsp;</td>
                    <!--td class="nowrap"><?php //echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['created']); ?>&nbsp;</td-->


                    <td class="actions">
                        <?php echo $this->Html->link(__d('phkapa','Verify'), array('action' => 'view', $ticket['Ticket']['id'])); ?>
                        <?php
                        if ($closeOk) {
                            echo ' | ' . $this->Html->link(__d('phkapa','Close'), array('action' => 'close', $ticket['Ticket']['id']), array('confirm'=> __d('phkapa','Are you sure you want to close # %s?', $ticket['Ticket']['id']).' '.$closeMessage));
                        }
                        ?>

                    </td>
                </tr>
            <?php endforeach; ?>
            <?php //echo '<tfoot class=\'dark\'>'.$tableHeaders.'</tfoot>';  ?>    </table>



        <p class="paging">
            <?php
            echo $this->Paginator->counter(array(
                'format' => __d('phkapa','Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
            ));
            ?>	</p>

        <div class="paging">
            <?php echo $this->Paginator->prev('<< ' . __d('phkapa','Previous'), array(), null, array('class' => 'disabled')); ?>
            | 	<?php echo $this->Paginator->numbers(); ?>
            |
            <?php echo $this->Paginator->Next(__d('phkapa','Next') . ' >>', array(), null, array('class' => 'disabled')); ?>
        </div>
        <?php
    } else {
        echo __d('phkapa','No records found!!!');
    }
    ?>
</div>
<div class="clear"></div>


