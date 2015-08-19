<?php $this->html->script('Phkapa.register_add', false); ?>
<h2 class="grid_16" id="page-heading"><?php echo __d('phkapa','Register').':'.__d('phkapa','Edit %s', __d('phkapa','Ticket')); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">
        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa','Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">
            <h5><?php echo __dn('phkapa','Ticket','Tickets',2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Ticket','Tickets',2)), array('action' => 'index')); ?></li>
            </ul>


        </div>

    </div>
    <div class="tickets form">
        <?php echo $this->Form->create(); ?>
        <fieldset class="ui-corner-all ui-widget-content" >
            <legend><?php echo __d('phkapa','Record').' '.__d('phkapa','Ticket'); ?></legend>
            <?php
            echo $this->Form->input('id');
            echo $this->Form->hidden('process_change');

            echo $this->Form->input('origin_date', array('label' => __d('phkapa','Origin Date'),'empty' => __d('phkapa','(choose one)'), 'dateFormat' => 'DMY', 'maxYear' => date('Y'), 'minYear' => date('Y') - 3, 'maxYear' => date('Y')));
            echo $this->Form->input('type_id', array('label' => __d('phkapa','Type'),'empty' => __d('phkapa','(choose one)')));
            echo $this->Form->input('origin_id', array('label' => __d('phkapa','Origin'),'empty' => __d('phkapa','(choose one)')));
            echo $this->Form->input('process_id', array('label' => __d('phkapa','Process'),'empty' => __d('phkapa','(choose one)'), 'after' =>
                $this->html->image("loading.gif", array("id" => "LoadProcessData", "alt" => __d('phkapa',"Loading process data"), "style" => "padding-left:10px;display:none;")), "#",
                array('escape' => false)
            ));
            ?>
            <div id='ProcessData'>
                <?php
                echo $this->Form->input('activity_id', array('label' => __d('phkapa','Activity'),'empty' => __d('phkapa','(choose one)')));
                echo $this->Form->input('category_id', array('label' => __d('phkapa','Category'),'empty' => __d('phkapa','(choose one)')));
                ?>
            </div>
            <?php
            echo $this->Form->input('supplier_id', array('label' => __d('phkapa','Supplier'),'empty' => __d('phkapa','(choose one)')));
            echo $this->Form->input('description',array('label' => __d('phkapa','Description')));
             echo "<br/>";
            echo $this->Form->input('priority_id', array('label' => __d('phkapa','Priority'),'empty' => __d('phkapa','(choose one)')));
            echo $this->Form->input('safety_id', array('label' => __d('phkapa','Safety'),'empty' => __d('phkapa','(choose one)')));            
            
            if (isset($this->request->data['Ticket']['ticket_parent'])) :
                echo "<hr/>";
                echo $this->Form->input('ticket_parent',array('min'=>'0','label' => __d('phkapa','Ticket Parent')));

            endif;
            ?>


        </fieldset>
        <?php echo $this->Form->end(__d('phkapa','Submit')); ?>
    </div>

</div>
<div class="clear"></div>
<div id="dialog-message" title="<?php echo __d('phkapa','Select Supplier'); ?>" >

    <!--p id="feedback">
        <span>You've selected:</span> <span id="select-result">none</span>.
    </p-->
    <ol id="selectable">

    </ol>
</div>
<?php echo $this->Js->writeBuffer(); ?>

