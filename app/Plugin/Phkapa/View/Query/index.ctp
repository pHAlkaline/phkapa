<h2 id="page-heading"><?php echo __dn('phkapa', 'Ticket', 'Tickets', 2); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">
        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa', 'Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">
            <h5><?php echo __dn('phkapa', 'Ticket', 'Tickets', 2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa', 'Export to CSV'), array('action' => 'export')); ?></li>
            </ul>
        </div>

    </div>

    <?php echo $this->element('searchBox'); ?>
    <?php if (!empty($tickets)) { ?>
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
                //$this->Paginator->sort('Category.name',__d('phkapa','Category')),
                $this->Paginator->sort('Activity.name', __d('phkapa', 'Activity')),
                __d('phkapa', 'Description'),
                //$this->Paginator->sort('created', __d('phkapa','Created')),
                $this->Paginator->sort('Workflow.order', __d('phkapa', 'Workflow')),
                //$this->Paginator->sort('modified'),
                array(__dn('phkapa', 'Action', 'Actions', 2) => array('class' => 'actions'))));
            echo '<thead class="ui-state-default">' . $tableHeaders . '</thead>';
            ?>

            <?php
            $i = 0;
            foreach ($tickets as $ticket):
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                $editable = false;
                $controller = null;
                $action = null;
                if ($ticket['Workflow']['id'] < 5) {
                    $editable = true;
                    switch ($ticket['Workflow']['id']) {
                        case 1:
                            $controller = 'register';
                            $action = 'edit';
                            break;
                        case 2:
                            $controller = 'review';
                            $action = 'edit';
                            break;
                        case 3:
                            $controller = 'plan';
                            $action = 'edit';
                            break;
                        case 4:
                            $controller = 'verify';
                            $action = 'view';
                            break;
                    }
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
                    <!--td><?php //echo $ticket['Category']['name'];  ?></td-->
                    <td><?php echo $ticket['Activity']['name']; ?></td>
                    <td><?php
                                echo $this->Text->truncate(
                                        $this->Text->autoParagraph($ticket['Ticket']['description']) . '<br/>' . $this->Text->autoParagraph($ticket['Ticket']['review_notes']), 60, array(
                                    'ellipsis' => '...',
                                    'exact' => false
                                ));
                                ?>&nbsp;</td>
                    <!--td class="nowrap"><?php //echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['created']); ?>&nbsp;</td-->

                    <td>
                        <?php echo $ticket['Workflow']['name']; ?>
                    </td>
                    <td class="actions">
                        <?php echo $this->Html->link(__d('phkapa', 'View'), array('action' => 'view', $ticket['Ticket']['id'])); ?>
                        <?php if ($editable): ?>
                            <?php echo ' | ' . $this->Html->link(__d('phkapa', 'Edit'), array('controller' => $controller, 'action' => $action, $ticket['Ticket']['id'])); ?>

                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php //echo '<tfoot class=\'dark\'>'.$tableHeaders.'</tfoot>';  ?>    </table>


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
