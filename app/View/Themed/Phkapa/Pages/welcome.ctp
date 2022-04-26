<?php
$this->layout = 'welcome';
$this->Html->script('jquery-zoom', false);
$url= AuthComponent::user('id') ? array('admin' => null, 'plugin' => 'phkapa', 'controller' => 'phkapa') : array('admin' => null, 'plugin' => null, 'controller' => 'users', 'action'=>'login');
?>
<div class="grid_16 actionsContainer">
       <div class="grid_16 centered" style="text-align:center" id="pHKapaHome">
            <div>
                <?php echo $this->Html->link($this->Html->image('pHKapalogo2.png', array('alt' => 'pHKapa')), Router::url($url, true), array('style' => '', 'class' => 'zoom logo2', 'target' => '_self', 'escape' => false)); ?>
            </div>
        </div>
    <div class="clear"></div>
</div>