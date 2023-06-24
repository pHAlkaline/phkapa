<h2 class="grid_16" id="page-heading"><?php echo $title_for_step; ?></h2>
<div class="grid_16 actionsContainer">

    <div class="install index">
        <div class = "ui-widget">
            <div class = "ui-state-highlight ui-corner-all message"  >
                <span class = "ui-icon ui-icon-alert" style = "float: left; margin: 3px;"></span>
                <?php
                echo __d('install','Dont forget to restore default access values to Config and tmp directory.');
               
                ?>
            </div>
        </div>

        <div class = "ui-widget">
            <div class = "ui-state-highlight ui-corner-all message" >
                <span class = "" style = "float: left; margin: 3px;"></span>
                <?php echo __d('install','Passwords secured and updated for all users');
                ?>
            </div>
        </div>	
        <div class = "ui-widget">
            <div class = "ui-state-highlight ui-corner-all message" >
                <span class = "" style = "float: left; margin: 3px;"></span>
                <?php echo __d('install','pHKapa: %s', $this->Html->link(Router::url('/', true), Router::url('/', true))); ?>
                <br/>
                <span class = "" style = "float: left; margin: 3px;"></span>
                <?php echo __d('install','Admin panel: %s', $this->Html->link(Router::url('/access', true), Router::url('/access', true))); ?>
                <br/>
                <span class = "" style = "float: left; margin: 3px;"></span>
                <?php echo __d('install','pHKapa Admin panel: %s', $this->Html->link(Router::url('/admin/phkapa', true), Router::url('/admin/phkapa', true))); ?>
            </div>
        </div>

        <div class = "ui-widget">
            <div class = "ui-state-highlight ui-corner-all message" style="border-color:green" >


                <h3><?php echo __d('install','Resources'); ?></h3>
                <ul >
                    <li><?php echo $this->Html->link('Official', 'https://phalkaline.net',array( 'target' => '_blank')); ?></li>
                    <li><?php echo $this->Html->link('Wiki', 'http://wiki.phkapa.net',array('target' => '_blank')); ?></li>
                    <li><?php echo $this->Html->link('pHKapa Google Group', 'http://groups.google.com/group/phkapa',array('target' => '_blank')); ?></li>
                    <li><?php echo $this->Html->link('Code repository', 'http://github.com/phalkaline/phkapa',array('target' => '_blank')); ?></li>
                    

            </div>
        </div>


    </div>
</div>