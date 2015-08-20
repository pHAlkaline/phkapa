<?php
if (AuthComponent::user('id')) {
    ?>
    <div style=" float:right; margin: 3px;" class="ui-state-default ui-corner-all" title="<?php echo __('End Session'); ?>">
        <a href="<?php echo Router::url('/users/logout', true); ?>" target="_self">
            <span class="ui-icon ui-icon-power"></span>
        </a>
    </div>

    <div style=" float:right; margin: 3px;" class="ui-state-default ui-corner-all notification" title="<?php echo __n('Notification', 'Notifications', 2) ?>">
        <a href="<?php echo Router::url('/pages/notifications', true); ?>" target="_self"><span class="ui-icon ui-icon-flag"></span></a>
    </div>

    <div style=" float:right; margin: 3px;" class="ui-state-default ui-corner-all" title="<?php echo __('Edit Profile'); ?>">
        <a href="<?php echo Router::url('/users/edit_profile', true); ?>" target="_self">
            <span class="ui-icon ui-icon-person"></span>
        </a>
    </div>
    <div style=" float:right; margin: 3px;" class="ui-state-default ui-corner-all" title="<?php echo __n('Aro', 'Aros', 2) ?>">
        <a href="<?php echo Router::url(array('admin' => null, 'plugin' => 'access', 'controller' => 'access', 'action' => 'index'), true); ?>" target="_self"><span class="ui-icon ui-icon-key"></span></a>
    </div>
    <div style=" float:right; margin: 3px;" class="ui-state-default ui-corner-all" title="<?php echo __d('phkapa', 'PHKAPA') . ' ' . __d('phkapa', 'Administration'); ?>">
        <a href="<?php echo Router::url('/admin/phkapa', true); ?>" target="_self"><span class="ui-icon ui-icon-wrench"></span></a></div>
    <div style=" float:right; margin: 3px;" class="ui-state-default ui-corner-all" title="<?php echo __d('phkapa', 'PHKAPA'); ?>">
        <a href="<?php echo Router::url('/phkapa', true); ?>" target="_self"><span class="ui-icon ui-icon-calculator"></span></a></div>    

    <div style="margin: 5px; float:right; color: #ffffff;"><?php echo $user_at_string; ?></div>


    <?php
}
?>