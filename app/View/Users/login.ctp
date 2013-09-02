<div class="grid_16">
    <h2 id="page-heading"><?php echo __('Start Session'); ?></h2>
    <div class="form ui-widget">
        <?php echo $this->Form->create('User'); ?>
        <fieldset class="ui-corner-all ui-widget-content" >
            <?php
            echo $this->Form->input('username',array('maxlength'=>'8','label' => __('Username')));
            echo $this->Form->input('password',array('maxlength'=>'8','label' => __('Password')));
            echo $this->Form->input('language', array('options' => Configure::read('Language.list'),'empty' => '(choose one)'));
            ?>

        </fieldset>
        <?php echo $this->Form->end(__('Start Session')); ?>
    </div>

</div>
<div class="clear"></div>
