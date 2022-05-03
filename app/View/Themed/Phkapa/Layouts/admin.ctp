<?php
$this->Number->defaultCurrency(Configure::read('currency'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
        <meta name="viewport" content="width=device-width, initial-scale=1"></meta>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>
        <?php
        echo $this->Html->meta('icon');
        echo $this->fetch('meta');
        echo $this->Html->css(array('reset', 'text', 'grid', 'layout', 'jquery-ui-theme/jquery-ui-1.8.23.custom', 'print'));
        echo $this->fetch('css');
        echo '<!--[if IE 6]>' . $this->Html->css('ie6') . '<![endif]-->';
        echo '<!--[if IE 7]>' . $this->Html->css('ie') . '<![endif]-->';
        ?>
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,700,600,800,900' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id="phkapa" ><!--img src="/img/pHKapa_small.png" alt="pHKapa"  /--></div>
        <div id="header">

            <h1>
                <?php echo $this->Html->link($this->Html->image('pHKapalogo2.png', array('alt' => 'pHKapa')), Router::url('/', true), array('class' => 'zoom', 'target' => '_self', 'escape' => false)); ?>

            </h1>

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
            <div class="clear"></div>
            <div class="grid_16">

                <?php // Possible menu here    ?>
                <?php
                if (isset($pluginImage)) {
                    echo '<div style="float: right; padding-right: 7px">' . $this->Html->image($pluginImage) . '</div>';
                }
                if (isset($menuItems)) {
                    echo $this->element('menu');
                }
                ?>
            </div>
            <?php //echo $this->Html->image('load.gif', array('id' => 'loading-indicator'));  ?>
            <div id="loading-indicator"></div>
            <div class="clear" style="height: 10px; width: 100%;"></div>
            <?php echo $this->Flash->render('Auth'); ?>
            <?php echo $this->Flash->render(); ?>
            <?php
            echo $this->fetch('content');
            ;
            ?>

            <div class="clear"></div>
        </div>
        <div style="text-align: center;">Copyright (c) pHAlkaline (<a href="http://phalkaline.net" target="_blank">http://phalkaline.net</a>)<div/>
            <?php //echo $this->element('sql_dump'); ?>
    </body>
        <?php
            echo $this->Html->script(array('jquery-1.8.0.min.js', 'jquery-ui-1.8.23.custom.min.js', 'jquery-cookie.js', 'spin.js'));
            echo $this->Html->script('loadingoverlay');
            echo $this->fetch('script');
            ?>
    <script>
        $(window).on('beforeunload', function ()
        {
            overlay();
        });
        $(window).on('beforeload', function () {
            overlay();
        });
        function overlay() {
            $.LoadingOverlaySetup({
                imageColor: "#00aeef"
            });
            $.LoadingOverlay("show");
            // Hide it after 3 seconds
            setTimeout(function () {
                $.LoadingOverlay("hide");
                $(".body").fadeIn(1500).trigger('bodyVisible');
            }, 500);
        }
    </script>
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
            $("#tabs").tabs();

            function blinkNotification() {
                $('.notification').delay(200).fadeTo(200, 0.5).delay(100).fadeTo(100, 1, blinkNotification);
            }


            <?php if (isset($unread_notifications) && $unread_notifications) { ?>
                blinkNotification();
            <?php } ?>

        });

    </script>
</html>
