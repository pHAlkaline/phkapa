<?php $title_for_layout = __('pHKapa') . ' ' . __n('Notification', 'Notifications', 1); ?>
<h2 id="page-heading"><?php echo $title_for_layout; ?></h2>
<div class="grid_16 actionsContainer">

    <?php
    if (!empty($notification)) {
        ?>
        <h2 id="page-heading"><?php echo __n('Notification', 'Notifications', 1) . ' : ' . $notification['Notification']['notification']; ?>&nbsp;&nbsp;</h2>
        <p><?php echo __('Created') . ' : ' . $this->Time->format(Configure::read('dateFormatSimple'), $notification['Notification']['created']); ?>&nbsp;&nbsp;</p>
        <p><?php echo __('Notifier') . ' : ' . h($notification['Notifier']['name']); ?>&nbsp;&nbsp;</p>
        <p></p>
        <p><?php echo __('Actions') . ' : '; ?>
            <?php
            if ($notification['Notification']['reference']) {
                echo $this->Html->link(__d('phkapa', 'View'), Router::url($notification['Notification']['reference'], true));
            }
            ?>&nbsp;&nbsp;</p>


        <?php
    } else {
        echo __d('phkapa', 'No records found!!!');
    }
    ?>
</div>
<div class="clear"></div>

