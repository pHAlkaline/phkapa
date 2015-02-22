<h2 id="page-heading"><?php echo __dn('phkapa', 'Origin', 'Origins', 2); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">	

        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa', 'Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">			
            <h5><?php echo __dn('phkapa', 'Origin', 'Origins', 2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Origin')), array('action' => 'add')); ?></li>
            </ul>

            <h5><?php echo __dn('phkapa', 'Ticket', 'Tickets', 2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa', 'List %s', __dn('phkapa', 'Ticket', 'Tickets', 2)), array('controller' => 'tickets', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa', 'Add %s', __d('phkapa', 'Ticket')), array('controller' => 'tickets', 'action' => 'add')); ?> </li>
            </ul>

        </div>
    </div>
    <?php
    if (!empty($origins)) {
        ?>
        <table cellpadding="0" cellspacing="0">
            <?php
            $tableHeaders = $this->html->tableHeaders(array(
                $this->Paginator->sort('id', __d('phkapa', 'Id')),
                $this->Paginator->sort('name', __d('phkapa', 'Name')),
                $this->Paginator->sort('active', __d('phkapa', 'Active')),
                $this->Paginator->sort('created', __d('phkapa', 'Created')),
                $this->Paginator->sort('modified', __d('phkapa', 'Modified')),
                __dn('phkapa', 'Action', 'Actions', 2)
                    ));
            echo '<thead class="ui-state-default"' . $tableHeaders . '</thead>';
            ?>

            <?php
            $i = 0;
            foreach ($origins as $origin):
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                ?>
                <tr<?php echo $class; ?>>
                    <td><?php echo $origin['Origin']['id']; ?>&nbsp;</td>
                    <td><?php echo $origin['Origin']['name']; ?>&nbsp;</td>
                    <td><?php echo $this->Utils->yesOrNo($origin['Origin']['active']); ?>&nbsp;</td>
                    <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $origin['Origin']['created']); ?>&nbsp;</td>
                    <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $origin['Origin']['modified']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__d('phkapa', 'View'), array('action' => 'view', $origin['Origin']['id'])); ?>
                        <?php echo ' | ' . $this->Html->link(__d('phkapa', 'Edit'), array('action' => 'edit', $origin['Origin']['id'])); ?>
                        <?php echo ' | ' . $this->Html->link(__d('phkapa', 'Delete'), array('action' => 'delete', $origin['Origin']['id']), array('confirm'=> __d('phkapa','Are you sure you want to delete # %s?', $origin['Origin']['name']))); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php //echo '<tfoot class=\'dark\'>'.$tableHeaders.'</tfoot>';   ?>    </table>


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
