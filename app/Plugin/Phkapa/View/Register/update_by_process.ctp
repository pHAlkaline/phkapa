<?php
$this->Form->create(null, array('default' => false));
echo $this->Form->input('activity_id', array('label' => __d('phkapa','Activity'),'empty' => __d('phkapa','(choose one)')));
echo $this->Form->input('category_id', array('label' => __d('phkapa','Category'),'empty' => __d('phkapa','(choose one)')));
$this->Form->end();
?>

