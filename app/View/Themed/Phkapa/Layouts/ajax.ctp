<?php
$this->Number->defaultCurrency(Configure::read('currency'));
?>
<?php echo $this->fetch('content'); ?>