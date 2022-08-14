<?php
$this->layout = 'welcome';
$this->Html->script('jquery-zoom', false);
$url= AuthComponent::user('id') ? array('admin' => null, 'plugin' => 'phkapa', 'controller' => 'query') : array('admin' => null, 'plugin' => null, 'controller' => 'users', 'action'=>'login');
if (!file_exists(TMP . 'installed.txt') || Configure::read('installed_key') == 'xyz') {
    $url= array('controller' => 'install', 'action' => 'index');
}
?>
<div class="row">
    <div class="centered text-center col-12">
        <a href="<?php echo Router::url($url); ?>" id="go-phkapa">
            <?php echo $this->Html->image('pHKapalogo2.png', array('alt' => 'phkapa', 'class' => 'img-responsive center-block animate__animated animate__zoomInDown animate__delay-1s')); ?>
        </a> 
       
    </div>
</div>

