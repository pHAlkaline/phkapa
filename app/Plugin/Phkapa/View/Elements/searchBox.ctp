<?php
if (isset($keyword)) {
    $this->Paginator->options(array('url' => array_merge($this->passedArgs, array('keyword' => $keyword))));
} else {
    $keyword = __('Search...');
}
$request=preg_replace('#(/page:)(\d+)#', '', $this->request->here);

?>
<div class="searchBox">
    <div class="search">
        <form method="get" action="<?php echo $request ?>" >
            <input type="text" onblur="if (this.value == '') this.value = '<?php echo __('Search...'); ?>';" onfocus="if (this.value == '<?php echo __('Search...'); ?>') this.value = '';" value="<?php echo $keyword ?>" id="keywords" name="keyword">
        </form>

    </div>
</div>