<h2 id="page-heading"><?php echo __n('User','Users',2); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">
            <h2>
                <a href="#" id="toggle-admin-actions"><?php echo __('Menu'); ?></a>
            </h2>
            <div class="block" id="admin-actions">
                <h5><?php echo __n('User','Users',2); ?></h5>
                <ul class="menu">
                    <li><?php echo $this->Html->link(__('Add %s', __('User')), array('action' => 'add')); ?></li>
                
            </div>
        
    </div>

    <?php if (count($users) > 0) { ?>

        <table cellpadding="0" cellspacing="0">
            <?php $tableHeaders = $this->html->tableHeaders( array(
                $this->Paginator->sort('id'),
                $this->Paginator->sort('name',__('Name')), 
                $this->Paginator->sort('username',__('Username')),
                $this->Paginator->sort('email',__('Email')),
                $this->Paginator->sort('active',__('Active')), 
                $this->Paginator->sort('modified',__('Modified')), 
                $this->Paginator->sort('created',__('Created')),
                __('Actions'),
                ));
            echo '<thead class="ui-state-default"' . $tableHeaders . '</thead>'; ?>

            <?php
            $i = 0;
            foreach ($users as $user):
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                ?>
                <tr<?php echo $class; ?>>
                    <td><?php echo $user['User']['id']; ?>&nbsp;</td>
                    <td><?php echo $user['User']['name']; ?>&nbsp;</td>
                    <td><?php echo $user['User']['username']; ?>&nbsp;</td>
                    <td><?php echo $user['User']['email']; ?>&nbsp;</td>
                    <td><?php echo $this->Utils->yesOrNo($user['User']['active']); ?>&nbsp;</td>
                    <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $user['User']['modified']); ?>&nbsp;</td>
                    <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $user['User']['created']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
                        <?php if ($user['User']['id']!=1) : ?>
                        <?php echo ' | ' . $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
                        <?php echo ' | ' . $this->Html->link(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php //echo '<tfoot class=\'dark\'>'.$tableHeaders.'</tfoot>';  ?>    </table>


        <p class="paging">
            <?php
            echo $this->Paginator->counter(array(
                'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
            ));
            ?>	</p>

        <div class="paging">
            <?php echo $this->Paginator->prev('<< ' . __('Previous'), array(), null, array('class' => 'disabled')); ?>
            | 	<?php echo $this->Paginator->numbers(); ?>
            |
            <?php echo $this->Paginator->Next(__('Next') . ' >>', array(), null, array('class' => 'disabled')); ?>
        </div>
        <?php
    } else {
       __('No records found!!!');
    }
    ?>
</div>
<div class="clear"></div>
