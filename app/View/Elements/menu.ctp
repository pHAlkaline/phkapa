<?php echo $this->Html->image('yourlogo.png', array('style'=>'float: right; height: 35px;','alt' => 'YourLogoHere')); ?>
<div class="block" id="admin-left-menu">
    <ul class="section menu">
        <?php
       
        foreach ($menuItems as $item):

            $itemDesc = $item;
            $itemTableize = Inflector::tableize($item);
            if (preg_match("/_/i", $itemTableize)) {
                $item = $itemTableize;
                $itemDesc = Inflector::humanize($itemTableize);
                
            }
            $itemSing = Inflector::singularize($item);
            ?>
            <li>
            <?php
            if (($this->request->params['controller'] == strtolower($item))) {
                echo $this->Html->link(__n($itemSing,$itemDesc,2), array('controller' => strtolower($item), 'action' => 'index'), array('class' => 'menuitem current'));
            } else {
                echo $this->Html->link(__n($itemSing,$itemDesc,2), array('controller' => strtolower($item), 'action' => 'index'), array('class' => 'menuitem'));
            }
            ?>
            </li>
            <?php endforeach; ?>

    </ul>
</div>