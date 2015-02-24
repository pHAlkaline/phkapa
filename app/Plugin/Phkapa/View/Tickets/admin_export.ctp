<h2 id="page-heading"><?php echo __dn('phkapa','Ticket','Tickets',2); ?></h2>
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
    <?php echo $this->Form->create('Ticket'); ?>
    <fieldset class="ui-corner-all ui-widget-content" >
        <legend><?php echo __d('phkapa','Export to Excel'); ?></legend>
        <div class="input">
        <label><?php echo ''; ?></label>
        <h5><?php echo __d('phkapa','Filter Origin Date'); ?></h5>
        </div>
            <?php
        $beginDate = explode("-", date('d-m-Y', strtotime('-1 month')));
        //$begin['hour'] = '00';
        //$begin['min'] = '00';
        $begin['year'] = $beginDate[2];
        $begin['month'] = $beginDate[1];
        $begin['day'] = $beginDate[0];
        $endDate = explode("-", date('d-m-Y'));
        //$end['hour'] = '23';
        //$end['min'] = '59';
        $end['year'] = $endDate[2];
        $end['month'] = $endDate[1];
        $end['day'] = $endDate[0];
        
        echo $this->html->div('input', $this->Form->label(__d('phkapa','Start Date')) . $this->Form->dateTime('startdate', $dateFormat = 'DMY', null, $attributes = array('value'=>$begin, 'label' => __d('phkapa','Start Date'), 'empty' => false, 'minYear' => '2009', 'maxYear' => date('Y') + 1)));
        echo $this->html->div('input', $this->Form->label(__d('phkapa','End Date')) . $this->Form->dateTime('enddate', $dateFormat = 'DMY', null, $attributes = array('value'=>$end, 'label' => __d('phkapa','End Date'), 'empty' => false, 'minYear' => '2009', 'maxYear' => date('Y') + 1)));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__d('phkapa','Download File')); ?>
</div>
<div class="clear"></div>

