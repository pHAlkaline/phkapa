<h2 id="page-heading"><?php echo __('View %s', __('User')); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">
        	
            <h2>
                <a href="#" id="toggle-admin-actions"><?php echo __('Menu'); ?></a>
            </h2>
            <div class="block" id="admin-actions">
                <h5><?php echo __n('User','Users',2); ?></h5>
                <ul class="menu">
                    <?php if ($user['User']['id']!=1) : ?>
                    <li><?php echo $this->Html->link(__('Edit %s', __('User')), array('action' => 'edit', $user['User']['id'])); ?> </li>
                    <li>
                        <?php echo $this->Html->link(__('Delete %s', __('User')), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['name'])); ?>
                        
                    </li>
                    <?php endif; ?>
                    <li><?php echo $this->Html->link(__('List %s', __n('User','Users',2)), array('action' => 'index')); ?> </li>
                    <li><?php echo $this->Html->link(__('Add %s', __('User')), array('action' => 'add')); ?> </li>
                </ul>
                
            </div>
       
    </div>
    <div class="box ui-corner-all ui-widget-content" >
        <div class="users view">

            <div class="block">
                <dl><?php $i = 0;
$class = ' class="altrow"'; ?>
                    <dt<?php if ($i % 2 == 0)
                        echo $class; ?>><?php echo __('Id'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php echo $user['User']['id']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __('Name'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php echo $user['User']['name']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __('Username'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php echo $user['User']['username']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __('Email'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php echo $user['User']['email']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __('Active'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php echo $this->Utils->yesOrNo($user['User']['active']); ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __('Modified'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php echo $this->Time->format(Configure::read('dateFormat'), $user['User']['modified']); ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0)
                                echo $class; ?>><?php echo __('Created'); ?></dt>
                    <dd<?php if ($i++ % 2 == 0)
                            echo $class; ?>>
                            <?php echo $this->Time->format(Configure::read('dateFormat'), $user['User']['created']); ?>
                        &nbsp;
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
