<h2 id="page-heading"><?php echo __n('Notification', 'Notifications', 1); ?>:<?php echo __d('phkapa', 'List %s', __n('Notification', 'Notifications', 2)); ?></h2>
<div class="grid_16 actionsContainer">

    <?php
    if (!empty($notifications)) {
        
        ?>
        <table cellpadding="0" cellspacing="0" >
            <?php
            $tableHeaders = $this->html->tableHeaders(array(
                __('Id'),
                __('Created'),
                __('Notifier'),
                __n('Notification', 'Notifications', 1),
                __('Read'),
                __('Actions')
                    ));
            echo '<thead class="ui-state-default">' . $tableHeaders . '</thead>';
            ?>

            <?php
            $i = 0;
            foreach ($notifications as $notification):
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                ?>
                <tr<?php echo $class; ?>>
                    <td><?php echo $notification['Notification']['id']; ?>&nbsp;</td>
                    <td class="nowrap"><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $notification['Notification']['created']); ?>&nbsp;</td>

                    <td class="nowrap"><?php echo $notification['Notifier']['name']; ?></td>
                    <td class="nowrap"><?php echo $notification['Notification']['notification']; ?></td>
                    <td class="nowrap"><?php echo $this->Utils->yesOrNo($notification['Notification']['read']); ?></td>
                    <td class="actions">

                        <?php
                        if ($notification['Notification']['reference']) {
                            echo $this->Html->link(__d('phkapa', 'View'), Router::url($notification['Notification']['reference'],true));
                           echo ' | '; 
                        }
                        echo $this->Html->link(__d('phkapa', 'Delete'), array('action' => 'notifications', 'delete', $notification['Notification']['id']), array('confirm', __d('phkapa', 'Are you sure you want to delete # %s?', $notification['Notification']['id'])));
                        ?>

                    </td>
                </tr>
            <?php endforeach; ?>
    <?php //echo '<tfoot class=\'dark\'>'.$tableHeaders.'</tfoot>';       ?>    </table>




        <?php
    } else {
        echo __d('phkapa', 'No records found!!!');
    }
    ?>
</div>
<div class="clear"></div>

