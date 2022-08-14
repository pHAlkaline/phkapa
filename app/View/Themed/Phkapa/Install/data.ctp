<h2 class="grid_16" id="page-heading"><?php echo $title_for_step; ?></h2>
<div class="grid_16 actionsContainer">



    <div class="data form">
        <?php echo $this->Form->create(false, array('url' => array('controller' => 'install', 'action' => 'data')));
        ?>
        <fieldset class="ui-corner-all ui-widget-content" >
            <legend><?php echo __d('install', 'Database and data'); ?></legend>
            <?php
            echo $this->Form->create(false, array('url' => array('controller' => 'install', 'action' => 'data')));
            echo $this->Form->hidden('run', array('value' => '1'));
            echo $this->Form->input('demo_data', array('type' => 'checkbox', 'label' => __d('install', 'Load data')));
            ?>
            <div class="ui-widget">
                <div class="ui-state-highlight ui-corner-all message" >
                    <span class="ui-icon ui-icon-info" style="float: left; margin: 3px;"></span>
                    <?php
                    echo __d('install', 'Check load data option to insert dafault values to action types, activities, categories, causes, origins, processes, suppliers, customers and finaly some example users and their access configuration.');
                    echo '<br/>';
                    ?>
                </div>
            </div>
            <?php echo $this->Form->submit(__('Submit'));
            ?>
        </fieldset>
        <?php echo $this->Form->end(); ?>

    </div>

</div>
<div class="clear"></div>
