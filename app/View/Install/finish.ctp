<h2 class="grid_16" id="page-heading"><?php echo $title_for_step; ?></h2>
<div class="grid_16 actionsContainer">

    <div class="install index">
        <div class = "ui-widget">
            <div class = "ui-state-highlight ui-corner-all message"  >
                <span class = "ui-icon ui-icon-alert" style = "float: left; margin: 3px;"></span>
                <?php
                echo __('Dont forget to restore default access values to Config and tmp directory.');
               
                ?>
            </div>
        </div>

        <div class = "ui-widget">
            <div class = "ui-state-highlight ui-corner-all message" >
                <span class = "" style = "float: left; margin: 3px;"></span>
                <?php echo __('Passwords secured and updated for all users');
                ?>
            </div>
        </div>	
        <div class = "ui-widget">
            <div class = "ui-state-highlight ui-corner-all message" >
                <span class = "" style = "float: left; margin: 3px;"></span>
                <?php echo __('PHKAPA: %s', $this->Html->link(Router::url('/', true), Router::url('/', true))); ?>
                <br/>
                <span class = "" style = "float: left; margin: 3px;"></span>
                <?php echo __('Admin panel: %s', $this->Html->link(Router::url('/admin', true), Router::url('/admin', true))); ?>
                <br/>
                <span class = "" style = "float: left; margin: 3px;"></span>
                <?php echo __('PHKAPA Admin panel: %s', $this->Html->link(Router::url('/admin/phkapa', true), Router::url('/admin/phkapa', true))); ?>
            </div>
        </div>

        <div class = "ui-widget">
            <div class = "ui-state-highlight ui-corner-all message" style="border-color:green" >


                <h3><?php echo __('Resources'); ?></h3>
                <ul >
                    <li><?php echo $this->Html->link('Official', 'http://phkapa.phalkaline.eu',array( 'target' => '_blank')); ?></li>
                    <li><?php echo $this->Html->link('Wiki', 'http://phkapa.phalkaline.eu/wiki',array('target' => '_blank')); ?></li>
                    <li><?php echo $this->Html->link('PHKAPA Google Group', 'http://groups.google.com/group/phkapa',array('target' => '_blank')); ?></li>
                    <li><?php echo $this->Html->link('Code repository', 'http://github.com/phalkaline/phkapa',array('target' => '_blank')); ?></li>
                    

            </div>
        </div>


    </div>
</div>