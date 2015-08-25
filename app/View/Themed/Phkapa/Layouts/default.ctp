<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>
        <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css(array('reset', 'text', 'grid', 'layout', 'jquery-ui-theme/jquery-ui-1.8.23.custom', 'print'));
        echo '<!--[if IE 6]>' . $this->Html->css('ie6') . '<![endif]-->';
        echo '<!--[if IE 7]>' . $this->Html->css('ie') . '<![endif]-->';
        ?>
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,700,600,800,900' rel='stylesheet' type='text/css'>

            <?php
            echo $this->Html->script(array('jquery-1.8.0.min.js', 'jquery-ui-1.8.23.custom.min.js', 'jquery-cookie.js', 'spin.js'));
            echo $this->fetch('meta');
            echo $this->fetch('css');
            echo $this->fetch('script');
            ?>
            <script type="text/javascript">
                $(document).ready(function () {

                    $('#mainContainer').fadeIn(1000);
                    if (!$.cookie('appMaintenance')) {
                        $('#maintenanceMessage').fadeIn(2000);
                    }
                    $('#maintenanceMessage').click(function () {
                        $.cookie('appMaintenance', 'foo');
                        $('#maintenanceMessage').fadeOut(2000);
                    })
                    $('.flash-message').click(function () {
                        $(this).fadeOut(500);
                    })

                    $("input:submit").button();
                    $("#actions").accordion({
                        collapsible: true,
                        active: false
                    });
                    $("#related").accordion({
                        collapsible: true,
                        autoHeight: false,
                        active: 0

                    });
                    $("#related-action").accordion({
                        collapsible: true,
                        autoHeight: false,
                        active: 0

                    });
                   
                    <?php if (isset($unread_notifications) && $unread_notifications) { ?>
                    blinkNotification();
                    <?php } ?>

                    function blinkNotification() {
                        $('.notification').delay(200).fadeTo(200, 0.5).delay(100).fadeTo(100, 1, blinkNotification);
                    }

                });

            </script>
    </head>
    <body>

        <div id="phkapa" ><!--img src="/img/pHKapa_small.png" alt="pHKapa"  --></div>
        <div id="header">
            <h1><?php echo $this->Html->link($this->Html->image('pHKapalogo2.png', array('alt' => 'pHKapa')), Router::url('/', true), array('class' => 'zoom', 'target' => '_self', 'escape' => false)); ?></h1>
        </div>

        <div id="header_separator" >
            <div style=" float:right; margin: 3px;" class="ui-state-default ui-corner-all" title="<?php echo __('Help'); ?>">
                <a href="http://wiki.phkapa.net" target="_blank">
                    <span class="ui-icon ui-icon-help"></span>
                </a>
            </div>
            <?php echo $this->element('topMenu'); ?>
        </div>

        <div class="clear" style="height: 35px;"></div>
        <div class="container_16" id="mainContainer">
            <!--div class="grid_16">
            <h1 id="branding">
            <a href="/"></a>
            </h1>
            </div-->
            <div class="clear"></div>
            <div class="grid_16">
                <?php // Possible menu here    ?>
                <?php
                if (isset($pluginImage)) {
                    echo '<div style="float: right; padding-right: 7px">' . $this->Html->image($pluginImage) . '</div>';
                }
                if (isset($menuItems)) {
                    if (!empty($this->request->params['plugin'])) {
                        $plugin = Inflector::humanize($this->request->params['plugin']);
                        echo $this->element($plugin . '.menu');
                    } else {
                        echo $this->element('menu');
                    }
                }
                ?>
            </div>
            <?php //echo $this->Html->image('load.gif', array('id' => 'loading-indicator'));     ?>
            <div id="loading-indicator"></div>
            <div class="clear" style="height: 10px; width: 100%;"></div>
            <?php echo $this->Flash->render(); ?>
            <?php echo $this->Flash->render('Auth'); ?>
            <?php echo $this->fetch('content'); ?>
            <div class="clear"></div>
        </div>
        <div style="text-align: center;">Copyright (c) pHAlkaline (<a href="http://phalkaline.eu" target="_blank">http://phalkaline.eu</a>)<div/>
            <?php // echo $this->element('sql_dump'); ?>
    </body>
</html>
