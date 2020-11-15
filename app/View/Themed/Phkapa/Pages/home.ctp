<?php $this->Html->script('jquery-zoom', false); ?>

<div class="grid_16 actionsContainer">
       <div class="grid_16" style="text-align:center" id="pHKapaHome">
            <?php echo $this->Html->image(Configure::read('Application.logo_image'), array('style' => 'float: right; height: 35px;', 'alt' => 'logo')); ?>
            <div>

                <?php echo $this->Html->link($this->Html->image('pHKapa_big.png', array('alt' => 'pHKapa')), Router::url(array('admin' => null, 'plugin' => 'phkapa', 'controller' => 'phkapa'), true), array('style' => '', 'class' => 'zoom logo2', 'target' => '_self', 'escape' => false)); ?>
            </div>
            <!--div id="zoomContainer">
                
                

            </div-->

        </div>
    <div class="clear"></div>
</div>