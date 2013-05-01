<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>
        <?php
        echo $this->Html->meta('icon');
        echo $this->Html->css(array('reset', 'text', 'grid', 'layout', 'ardislogis/jquery-ui-1.8.23.custom'));
        echo '<!--[if IE 6]>' . $this->Html->css('ie6') . '<![endif]-->';
        echo '<!--[if IE 7]>' . $this->Html->css('ie') . '<![endif]-->';
        echo $this->Html->script(array('jquery-1.8.0.min.js', 'jquery-ui-1.8.23.custom.min.js', 'jquery-cookie.js', 'spin.js'));
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
                    color: '#df0024', // #rgb or #rrggbb
                    speed: 1, // Rounds per second
                    trail: 54, // Afterglow percentage
                    shadow: false // Whether to render a shadow
                };
                var target = document.getElementById('loading-indicator');
                $("a").bind('click', function (e) {
                    //console.log(e.result);
                    if (e.result==false) return false;
                    if (this.id=='setTodaysDate') return;
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
    </head>
    <body>
         <div id="phkapa" ><!--img src="/img/PHKAPA_small.png" alt="PHKAPA"  --></div>
        <div id="header">
            <h1><?php echo $this->Html->image('PHKAPAlogo.png', array('alt' => 'PHKAPA')); ?></h1>
        </div>

        <div id="header_separator">
            <?php
            
            ?>
        </div>
        <div class="clear" style="height: 35px;"></div>
        <div class="container_16" id="mainContainer">
            <div class="clear"></div>
            <div class="grid_16">
                <?php // Possible menu here  ?>
                <?php
                
                ?>
            </div>
            <div id="loading-indicator"></div>
            <div class="clear" style="height: 10px; width: 100%;"></div>
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->Session->flash('auth', array('element' => 'flash_message_error')); ?>
            <?php echo $this->Session->flash('maintenance'); ?>
            <?php echo $this->fetch('content'); ?>
            <div class="clear"></div>
        </div>

        </body>
</html>