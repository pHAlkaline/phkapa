<h2 id="page-heading"><?php echo __dn('phkapa','Action','Actions',2); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">

        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa','Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">
            <h5><?php echo __dn('phkapa','Action','Actions',2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Action')), array('action' => 'add')); ?></li>
            </ul>

            <h5><?php echo __dn('phkapa','Ticket','Tickets',2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Ticket','Tickets',2)), array('controller' => 'tickets', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Ticket')), array('controller' => 'tickets', 'action' => 'add')); ?> </li>
            </ul>
        </div>

    </div>
    <?php
    if (!empty($actions)) {
        ?>
    <?php echo $this->element('searchBox'); ?>
    
    <table cellpadding="0" cellspacing="0">
        <?php
        $tableHeaders = $this->html->tableHeaders(array(
            $this->Paginator->sort('id',__d('phkapa','Id')), 
            $this->Paginator->sort('ticket_id',__d('phkapa','Ticket')), 
            $this->Paginator->sort('action_type_id',__d('phkapa','Action Type')), 
            __d('phkapa','Description'), 
            $this->Paginator->sort('deadline',__d('phkapa','Deadline')), 
            $this->Paginator->sort('closed',__d('phkapa','Closed')), 
            $this->Paginator->sort('close_date',__d('phkapa','Close Date')), 
            __d('phkapa','Effectiveness'), 
            $this->Paginator->sort('effectiveness_notes',__d('phkapa','Effectiveness Notes')), 
            $this->Paginator->sort('modified',__d('phkapa','Modified')), 
            $this->Paginator->sort('created',__d('phkapa','Created')), 
            __dn('phkapa','Action','Actions',2),));
        echo '<thead class="ui-state-default"' . $tableHeaders . '</thead>';
        ?>

        <?php
        $i = 0;
        foreach ($actions as $action):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
            <tr<?php echo $class; ?>>
                <td><?php echo $action['Action']['id']; ?>&nbsp;</td>
                <td>
                    <?php echo $this->Html->link($action['Ticket']['id'], array('controller' => 'tickets', 'action' => 'view', $action['Ticket']['id'])); ?>
                </td>
                <td>
                    <?php echo $action['ActionType']['name']; ?>&nbsp;
                </td>
                <td><?php echo $action['Action']['description']; ?>&nbsp;</td>
                <td><?php echo $action['Action']['deadline']; ?>&nbsp;</td>
                <td><?php echo $this->Utils->yesOrNo($action['Action']['closed']); ?>&nbsp;</td>
                <td class="nowrap"><?php
                if ($action['Action']['close_date'] != '')
                    echo $this->Time->format(Configure::read('dateFormatSimple'), $action['Action']['close_date']);
                    ?>&nbsp;</td>
                <td><?php echo $action['ActionEffectiveness']['name']; ?>&nbsp;</td>
                <td><?php echo $action['Action']['effectiveness_notes']; ?>&nbsp;</td>
                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $action['Action']['modified']); ?>&nbsp;</td>
                <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $action['Action']['created']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__d('phkapa','View'), array('action' => 'view', $action['Action']['id'])); ?>
                    <?php echo ' | ' . $this->Html->link(__d('phkapa','Edit'), array('action' => 'edit', $action['Action']['id'])); ?>
                    <?php echo ' | ' . $this->Html->link(__d('phkapa','Delete'), array('action' => 'delete', $action['Action']['id']), null, __d('phkapa','Are you sure you want to delete # %s?', $action['Action']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php //echo '<tfoot class=\'dark\'>'.$tableHeaders.'</tfoot>';    ?>    </table>


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
