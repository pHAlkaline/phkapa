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
            <style>
                .centered {
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    /* bring your own prefixes */
                    transform: translate(-50%, -50%);
                }
            </style>
    </head>
    <body>
        <body>
            <div class="container_16" id="mainContainer">
                <div class="clear"></div>
            <?php echo $this->fetch('content'); ?>
            </div>
            <div style="position:fixed;bottom:0;left:50%;transform: translate(-50%, -50%);">
             <?php echo $this->Flash->render(); ?>
            </div>
        </body>

        <?php
            echo $this->Html->script(array('jquery-1.8.0.min.js', 'jquery-ui-1.8.23.custom.min.js', 'jquery-cookie.js', 'spin.js'));
            echo $this->fetch('script');
            ?>
        <script type="text/javascript">
            $(document).ready(function () {

                $('#mainContainer').fadeIn(2000);
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
        <script type="text/javascript">
            $(document).ready(function () {
                const myClickAnchor = setTimeout(clickAnchor, 3000);

                function clickAnchor() {
                    $('#go-phkapa')[0].click();
                }
            });
        </script>
</html>
