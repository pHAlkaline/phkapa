<?php if (AuthComponent::user('id')) : ?>
    <div style=" float:right; margin: 3px;" class="ui-state-default ui-corner-all" title="<?php echo __('End Session'); ?>">
        <a href="<?php echo Router::url(array('admin' => null, 'plugin' => null, 'controller' => 'users', 'action' => 'logout'), true); ?>" target="_self">
            <span class="ui-icon ui-icon-power"></span>
        </a>
    </div>
    <div style=" float:right; margin: 3px;" class="ui-state-default ui-corner-all" title="<?php echo __dn('access', 'Aro', 'Aros', 2) ?>">
        <a href="<?php echo Router::url(array('admin' => null, 'plugin' => 'access', 'controller' => 'aros'), true); ?>" target="_self"><span class="ui-icon ui-icon-key"></span></a>
    </div>
    <div style=" float:right; margin: 3px;" class="ui-state-default ui-corner-all" title="<?php echo __d('phkapa', 'pHKapa') . ' ' . __d('phkapa', 'Setup'); ?>">
        <a href="<?php echo Router::url(array('admin' => true, 'plugin' => 'phkapa', 'controller' => 'tickets'), true); ?>" target="_self"><span class="ui-icon ui-icon-wrench"></span></a>
    </div>
    <div style=" float:right; margin: 3px;" class="ui-state-default ui-corner-all" title="<?php echo __('Edit Profile'); ?>">
        <a href="<?php echo Router::url(array('admin' => null, 'plugin' => null, 'controller' => 'users', 'action' => 'edit_profile'), true); ?>" target="_self">
            <span class="ui-icon ui-icon-person"></span>
        </a>
    </div>
    <div style=" float:right; margin: 3px;" class="ui-state-default ui-corner-all notification" title="<?php echo __n('Notification', 'Notifications', 2) ?>">
        <a href="<?php echo Router::url(array('admin' => null, 'plugin' => null, 'controller' => 'pages', 'action' => 'notifications'), true); ?>" target="_self"><span class="ui-icon ui-icon-flag"></span></a>
    </div>
    <div style=" float:right; margin: 3px;" class="ui-state-default ui-corner-all" title="<?php echo __d('phkapa', 'pHKapa'); ?>">
        <a href="<?php echo Router::url(array('admin' => false, 'plugin' => 'phkapa', 'controller' => 'query'), true); ?>" target="_self"><span class="ui-icon ui-icon-calculator"></span></a>
    </div>    

    <div style="margin: 5px; float:right; color: #ffffff;"><?php echo $user_at_string; ?></div>


<?php endif; ?>