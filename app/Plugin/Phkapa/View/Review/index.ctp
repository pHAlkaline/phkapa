<h2 id="page-heading"><?php echo __d('phkapa', 'Review'); ?>:<?php echo __d('phkapa', 'List %s', __dn('phkapa', 'Ticket', 'Tickets', 2)); ?></h2>
<div class="grid_16 actionsContainer">

    <?php if (!empty($tickets)) {
        ?>
        <table cellpadding="0" cellspacing="0" >
            <?php
            $tableHeaders = $this->html->tableHeaders(array(
                $this->Paginator->sort('id', __d('phkapa', 'Id')),
                $this->Paginator->sort('Priority.order',__d('phkapa','Priority')),
                $this->Paginator->sort('Safety.order',__d('phkapa','Safety')),
                $this->Paginator->sort('origin_date', __d('phkapa', 'Origin Date')),
                $this->Paginator->sort('Type.name', __d('phkapa', 'Type')),
                $this->Paginator->sort('Origin.name', __d('phkapa', 'Origin')),
                $this->Paginator->sort('Process.name', __d('phkapa', 'Process')),
                //$this->Paginator->sort('Category.name', __d('phkapa', 'Category')),
                $this->Paginator->sort('Activity.name', __d('phkapa', 'Activity')),
                __d('phkapa', 'Description'),
                $this->Paginator->sort('approved', __d('phkapa', 'Approved')),
                //$this->Paginator->sort('created', __d('phkapa', 'Created')),
                //$this->Paginator->sort('modified'),
                __dn('phkapa', 'Action', 'Actions', 2)));
            echo '<thead class="ui-state-default">' . $tableHeaders . '</thead>';
            ?>

            <?php
            $i = 0;
            foreach ($tickets as $ticket):
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
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
                    <td><?php echo $ticket['Ticket']['description'].'<br/>'.$ticket['Ticket']['review_notes']; ?>&nbsp;</td>
                    <td><?php echo $this->Utils->yesOrNo($ticket['Ticket']['approved']); ?></td>
                    <!--td class="nowrap"><?php //echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['created']); ?>&nbsp;</td-->

                    <td class="actions">
                         <?php echo $this->Html->link(__d('phkapa', 'Edit'), array('action' => 'edit', $ticket['Ticket']['id'])); ?>

                        <?php
                        if ($sendOk) {
                            echo ' | '. $this->Html->link(__d('phkapa', 'Send'), array('action' => 'send', $ticket['Ticket']['id']), null, __d('phkapa', 'Are you sure you want to send # %s?', $ticket['Ticket']['id']));
                            
                        }
                        ?>
                        <?php
                        if ($closeOk) {
                            echo ' | ' . $this->Html->link(__d('phkapa', 'Close'), array('action' => 'close', $ticket['Ticket']['id']), null, __d('phkapa', 'Are you sure you want to send # %s?', $ticket['Ticket']['id']));
                            
                        }
                        ?>
                       

                    </td>
                </tr>
            <?php endforeach; ?>
            <?php //echo '<tfoot class=\'dark\'>'.$tableHeaders.'</tfoot>';     ?>    </table>

        <p class="paging">
            <?php
            echo $this->Paginator->counter(array(
                'format' => __d('phkapa', 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
            ));
            ?>	</p>

        <div class="paging">
            <?php echo $this->Paginator->prev('<< ' . __d('phkapa', 'Previous'), array(), null, array('class' => 'disabled')); ?>
            | 	<?php echo $this->Paginator->numbers(); ?>
            |
            <?php echo $this->Paginator->Next(__d('phkapa', 'Next') . ' >>', array(), null, array('class' => 'disabled')); ?>

        </div>
        <?php
    } else {
        echo __d('phkapa', 'No records found!!!');
    }
    ?>
</div>
<div class="clear"></div>

