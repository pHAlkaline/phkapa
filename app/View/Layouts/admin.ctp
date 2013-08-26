<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>
        <?php
        echo $this->Html->meta('icon');
        //echo $this->Html->css('cake.generic');
        echo $this->Html->css(array('reset', 'text', 'grid', 'layout', 'jquery-ui-theme/jquery-ui-1.8.23.custom'));
        echo '<!--[if IE 6]>' . $this->Html->css('ie6') . '<![endif]-->';
        echo '<!--[if IE 7]>' . $this->Html->css('ie') . '<![endif]-->';
        echo $this->Html->script(array('jquery-1.8.0.min.js', 'jquery-ui-1.8.23.custom.min.js', 'jquery-fluid16.js', 'jquery-cookie.js', 'spin.js'));
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                //$('#phkapa').fadeIn(2000);
                $('#mainContainer').fadeIn(1000);
                if (!$.cookie('appMaintenance')){
                    $('#maintenanceMessage').fadeIn(2000);
                }
                $('#maintenanceMessage').click(function(){
                    $.cookie('appMaintenance','foo');
                    $('#maintenanceMessage').fadeOut(2000);
                })
                $('.flash_message').click(function(){
                    alert("hello");
                    $(this).fadeOut(500);
                })
                $("a").each(function(){
                    var onClickEval=$(this).attr('onclick');
                    if (/confirm/i.test(onClickEval)){
                        //console.log(onClickEval);
                        $(this).attr('onClickEval',onClickEval);
                        $(this).removeAttr('onclick');
                        $(this).bind('click', function (e) {
                            var evalString=$(this).attr('onClickEval');
                            evalString=evalString.match(/'.*'/);
                            result = confirm (evalString);
                            //console.log(e.result);
                            return result;
                        });
                    }  
                    
                });
                
                var opts = {
                    lines: 8, // The number of lines to draw
                    length: 11, // The length of each line
                    width: 3, // The line thickness
                    radius: 6, // The radius of the inner circle
                    color: '#00aeef', // #rgb or #rrggbb
                    speed: 1, // Rounds per second
                    trail: 54, // Afterglow percentage
                    shadow: false // Whether to render a shadow
                };
                var target = document.getElementById('loading-indicator');
                $("a").bind('click', function (e) {
                    //console.log(e.result);
                    if (e.result==false) return false;
                    if (this.id=='toggle-admin-actions') return;
                    if (this.id=='toggle-related-records') return;
                    if (this.target=='_blank') return true;
                    $("#mainContainer div, h2").slice(4).hide();
                    var spinner = new Spinner(opts).spin(target);
                    $("#loading-indicator").show();
                    return true;
                });
                
                
                $("form").submit(function () {
                    var frmAction=$(this).attr('action');
                    if (/export/i.test(frmAction)){ return true;}
                    $("#mainContainer div, h2").slice(4).hide();
                    var spinner = new Spinner(opts).spin(target);
                    $("#loading-indicator").show();
                    return true;
                    
                });
                
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
               
                
                
				
            });
            
        </script>
        <script>
                $(document).ready(function () {
                <?php
                if (isset($unread_notifications) && $unread_notifications) { ?>
                    blinkNotification();
                <?php } ?>
                });
                    
                function blinkNotification(){
                    $('.notification').delay(200).fadeTo(200,0.5).delay(100).fadeTo(100,1, blinkNotification);
                }    

            </script>
    </head>
    <body>
        <div id="phkapa" ><!--img src="/img/PHKAPA_small.png" alt="PHKAPA"  /--></div>
        <div id="header">

            <h1>
                <?php echo $this->Html->link($this->Html->image('PHKAPAlogo2.png', array('alt' => 'PHKAPA')), '/admin/' . $admin_root, array('class' => 'zoom', 'target' => '_self', 'escape' => false)); ?>

            </h1>

        </div>
        <div id="header_separator">
            <div style=" float:right; margin: 3px;" class="ui-state-default ui-corner-all" title="<?php echo __('Help'); ?>">
                <a href="http://phkapa.phalkaline.eu/wiki" target="_blank">
                    <span class="ui-icon ui-icon-help"></span>
                </a>
            </div>
            <?php
            if ($this->Session->read('Auth.User.name')) {
                ?>
                <div style=" float:right; margin: 3px;" class="ui-state-default ui-corner-all" title="<?php echo __('End Session'); ?>">
                    <a href="/users/logout" target="_self">
                        <span class="ui-icon ui-icon-power"></span>
                    </a>
                </div>
            <div style=" float:right; margin: 3px;" class="ui-state-default ui-corner-all notification" title="<?php echo __d('phkapa', 'Notifications'); ?>">
                    <a href="/pages/notifications" target="_self"><span class="ui-icon ui-icon-flag"></span></a>
                </div>

                <div style=" float:right; margin: 3px;" class="ui-state-default ui-corner-all" title="<?php echo __('Edit Profile'); ?>">
                    <a href="/users/edit" target="_self">
                        <span class="ui-icon ui-icon-person"></span>
                    </a>
                </div>
                <?php if ($admin_root == "phkapa") { ?>
                    <div style=" float:right; margin: 3px;" class="ui-state-default ui-corner-all" title="<?php echo __n('Aro', 'Aros', 2) ?>">
                        <a href="/admin" target="_self"><span class="ui-icon ui-icon-key"></span></a>
                    </div>

                    <div style=" float:right; margin: 3px;" class="ui-state-default ui-corner-all" title="<?php echo __d('phkapa', 'PHKAPA'); ?>">
                        <a href="/" target="_self"><span class="ui-icon ui-icon-calculator"></span></a></div>
                    <div style="margin: 5px; float:right; color: #ffffff;"><?php echo __('User') . ' ' . $this->Session->read('Auth.User.name') . ' @ ' . __d('phkapa', 'PHKAPA') . ' ' . __d('phkapa', 'Administration'); ?> </div>
                <?php } else { ?>
                    <div style=" float:right; margin: 3px;" class="ui-state-default ui-corner-all" title="<?php echo __d('phkapa', 'PHKAPA') . ' ' . __d('phkapa', 'Administration'); ?>">
                        <a href="/admin/phkapa" target="_self"><span class="ui-icon ui-icon-wrench"></span></a>
                    </div>

                    <div style=" float:right; margin: 3px;" class="ui-state-default ui-corner-all" title="<?php echo __d('phkapa', 'PHKAPA'); ?>">
                        <a href="/" target="_self"><span class="ui-icon ui-icon-calculator"></span></a></div>
                    <div style="margin: 5px; float:right; color: #ffffff;"><?php echo __('User') . ' ' . $this->Session->read('Auth.User.name') . ' @ ' . __n('Aro', 'Aros', 2) . ' ' . __d('phkapa', 'Administration') ?> </div>
                <?php } ?>
                

                <?php
            }
            ?>
        </div>
        <div class="clear" style="height: 35px;"></div>
        <div class="container_16" id="mainContainer">
            <div class="clear"></div>
            <div class="grid_16">

                <?php // Possible menu here  ?>
                <?php
                if (isset($pluginImage)) {
                    echo '<div style="float: right; padding-right: 7px">' . $this->Html->image($pluginImage) . '</div>';
                }
                if (isset($menuItems)) {
                    echo $this->element('menu');
                }
                ?>
            </div>
            <?php //echo $this->Html->image('load.gif', array('id' => 'loading-indicator')); ?>
            <div id="loading-indicator"></div>
            <div class="clear" style="height: 10px; width: 100%;"></div>

            <?php echo $this->Session->flash(); ?>
            <?php echo $this->Session->flash('auth'); ?>
            <?php echo $this->Session->flash('maintenance'); ?>
            <?php
            echo $this->fetch('content');
            ;
            ?>

            <div class="clear"></div>
        </div>
        <?php echo $this->element('sql_dump'); ?>
    </body>
</html>
