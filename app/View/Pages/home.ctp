<?php $this->Html->script('jquery-zoom', false); ?>

<div class="grid_16 actionsContainer">
    <?php if (AuthComponent::user('id')) { ?>
    <div class="grid_16" style="text-align:center" id="PHKAPAHome">

        <div>
            <?php echo $this->Html->link($this->Html->image('PHKAPA_big.png', array('alt' => 'PHKAPA')), Router::url('/phkapa', true), array('class' => 'zoom', 'target' => '_self', 'escape' => false)); ?>
        </div>
        <!--div id="zoomContainer">
            
            

        </div-->

    </div>
    <?php } else { ?>
    <div class="grid_16">
    <h2 id="page-heading"><?php echo __('Start Session'); ?></h2>
    <div class="form ui-widget">
        <?php echo $this->Form->create('User',array('url' => '/users/login')); ?>
        <fieldset class="ui-corner-all ui-widget-content" >
            <?php
            echo $this->Form->input('username',array('maxlength'=>'8','label' => __('Username')));
            echo $this->Form->input('password',array('maxlength'=>'8','label' => __('Password')));
            ?>

        </fieldset>
        <?php echo $this->Form->end(__('Start Session')); ?>
    </div>

</div>
<div class="clear"></div>
    <?php } ?>
    <div class="clear"></div>

</div>