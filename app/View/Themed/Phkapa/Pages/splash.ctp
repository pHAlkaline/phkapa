<?php $this->layout = 'splash'; ?>
<?php $this->Html->script('jquery-zoom', false); ?>

<div class="grid_16 actionsContainer">
       <div class="grid_16 centered" style="text-align:center" id="pHKapaHome">
            <div>

                <?php echo $this->Html->link($this->Html->image('pHKapalogo2.png', array('alt' => 'pHKapa')), Router::url(array('admin' => null, 'plugin' => 'phkapa', 'controller' => 'phkapa'), true), array('style' => '', 'class' => 'zoom logo2', 'target' => '_self', 'escape' => false)); ?>
            </div>
            <!--div id="zoomContainer">
                
                

            </div-->

        </div>
    <div class="clear"></div>
</div>