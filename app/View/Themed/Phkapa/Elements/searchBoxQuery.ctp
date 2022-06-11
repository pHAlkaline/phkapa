<?php

$this->Paginator->options(array(
  'convertKeys' => array('keyword', 'hide_closed')
));
//array('url' => array_merge($this->passedArgs, $passedArgs)));

$request = preg_replace('#(/page:)(\d+)#', '', $this->request->here);

?>
<div class="searchBox">
    <div class="search">
        <form method="get" action="<?php echo $request ?>" >
            <input type="text" onblur="if (this.value == '')
                        this.value = '<?php echo __('Search...'); ?>';" onfocus="if (this.value == '<?php echo __('Search...'); ?>')
                                    this.value = '';"  value="<?= isset($keyword) ? $keyword : __('Search...') ?>" id="keywords" name="keyword" />
            <input type="checkbox" name="hide_closed" id="hide-closed" <?= (isset($hide_closed) && $hide_closed == 'on') ? 'checked' : '' ?> onchange="getElementById('keywords').focus();this.form.submit();" />
            <label for="hide-closed" ><?php echo __('Hide Closed'); ?></label>
        </form>
    </div>

</div>
