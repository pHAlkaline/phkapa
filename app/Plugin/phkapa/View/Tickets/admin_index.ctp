<h2 id="page-heading"><?php echo __dn('phkapa', 'Ticket', 'Tickets', 2); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">	

        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa', 'Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">
            <h5><?php echo __dn('phkapa', 'Ticket', 'Tickets', 2); ?></h5>
            <ul class="menu">

                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Ticket')), array('action' => 'add')); ?></li>
                <li><?php echo $this->Html->link(__d('phkapa', 'Export to Excel'), array('action' => 'export')); ?></li>
            </ul>
            </ul>
             
        </div>

    </div>

    <?php echo $this->element('searchBox'); ?>
    <?php
    if (!empty($tickets)) {
        ?>
        <table cellpadding="0" cellspacing="0">
            <?php
            $tableHeaders = $this->html->tableHeaders(array(
                $this->Paginator->sort('id', __d('phkapa', 'Id')),
                $this->Paginator->sort('Priority.order', __d('phkapa', 'Priority')),
                $this->Paginator->sort('origin_date', __d('phkapa', 'Origin Date')),
                $this->Paginator->sort('Type.name', __d('phkapa', 'Type')),
                $this->Paginator->sort('Origin.name', __d('phkapa', 'Origin')),
                $this->Paginator->sort('Process.name', __d('phkapa', 'Process')),
                $this->Paginator->sort('Category.name', __d('phkapa', 'Category')),
                $this->Paginator->sort('Activity.name', __d('phkapa', 'Activity')),
                __d('phkapa', 'Description'),
                $this->Paginator->sort('created', __d('phkapa', 'Created')),
                $this->Paginator->sort('Workflow.name', __d('phkapa', 'Workflow')),
                //$this->Paginator->sort('created'),
                __dn('phkapa', 'Action', 'Actions', 2)));
            echo '<thead class="ui-state-default"' . $tableHeaders . '</thead>';
            ?>

            <?php
            $i = 0;
            foreach ($tickets as $ticket):
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                ?>
                <tr<?php echo $class; ?>>
                    <td><?php echo $ticket['Ticket']['id']; ?>&nbsp;</td>
                    <td><?php echo $this->Html->link($ticket['Priority']['name'], array('controller' => 'priorities', 'action' => 'view', $ticket['Priority']['id'])); ?></td>
                    <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['origin_date']); ?>&nbsp;</td>
                    <td><?php echo $this->Html->link($ticket['Type']['name'], array('controller' => 'types', 'action' => 'view', $ticket['Type']['id'])); ?></td>
                    <td><?php echo $this->Html->link($ticket['Origin']['name'], array('controller' => 'origins', 'action' => 'view', $ticket['Origin']['id'])); ?></td>
                    <td><?php echo $this->Html->link($ticket['Process']['name'], array('controller' => 'processes', 'action' => 'view', $ticket['Process']['id'])); ?></td>
                    <td><?php echo $this->Html->link($ticket['Category']['name'], array('controller' => 'categories', 'action' => 'view', $ticket['Category']['id'])); ?></td>
                    <td><?php echo $this->Html->link($ticket['Activity']['name'], array('controller' => 'activities', 'action' => 'view', $ticket['Activity']['id'])); ?></td>

                    <td><?php echo $ticket['Ticket']['description'] . '<br/>' . $ticket['Ticket']['review_notes']; ?>&nbsp;</td>
                    <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['created']); ?>&nbsp;</td>
                    <td>
                        <?php echo $ticket['Workflow']['name']; ?>
                    </td>
                    <td class="actions">
                        <?php echo $this->Html->link(__d('phkapa', 'View'), array('action' => 'view', $ticket['Ticket']['id'])); ?>
                        <?php echo ' | ' . $this->Html->link(__d('phkapa', 'Edit'), array('action' => 'edit', $ticket['Ticket']['id'])); ?>
                        <?php echo ' | ' . $this->Html->link(__d('phkapa', 'Delete'), array('action' => 'delete', $ticket['Ticket']['id']), array('escape' => false), __d('phkapa', 'Are you sure you want to delete # %s?', $ticket['Ticket']['id']) . ' ' . __d('phkapa', 'Related Child Tickets and actions will also be deleted!!')); ?>
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
            <?php echo $this->Paginator->prev('<< ' . __d('phkapa', 'Previous'), array(), null, array('class' => 'disabled')); ?> | <?php echo $this->Paginator->numbers(); ?> |
            <?php echo $this->Paginator->Next(__d('phkapa', 'Next') . ' >>', array(), null, array('class' => 'disabled')); ?>
        </div>
        <?php
    } else {
        echo __d('phkapa', 'No records found!!!');
    }
    ?>
</div>
<div class="clear"></div>
