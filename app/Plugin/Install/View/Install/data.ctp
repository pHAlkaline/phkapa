<h2 class="grid_16" id="page-heading"><?php echo $title_for_step; ?></h2>
<div class="grid_16 actionsContainer">



    <div class="data form">
        <?php echo $this->Form->create(false, array('url' => array('controller' => 'install', 'action' => 'data')));
        ?>
        <fieldset class="ui-corner-all ui-widget-content" >
            <legend><?php echo __('Database and data'); ?></legend>
            <?php
            echo $this->Form->create(false, array('url' => array('controller' => 'install', 'action' => 'data')));
            echo $this->Form->hidden('run', array('value' => '1'));
            echo $this->Form->input('demo_data', array('type' => 'checkbox', 'label' => __('Load data')));
            ?>
            <div class="ui-widget">
                <div class="ui-state-highlight ui-corner-all message" >
                    <span class="ui-icon ui-icon-info" style="float: left; margin: 3px;"></span>
                    <?php 
                    echo __('Check load data option to insert dafault values to action types, activities, categories, causes, origins, processes, suppliers and finaly some example users and their access configuration.');
                    echo '<br/>';
                   
                    ?>
                </div>
            </div>
            

        </fieldset>
        <?php echo $this->Form->end(__('Submit')); ?>
    </div>

</div>
<div class="clear"></div>
