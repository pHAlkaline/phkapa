<h2 id="page-heading"><?php echo __dn('phkapa','User','Users',2); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">

        <h2>
            <a href="#" id="toggle-admin-actions"><?php echo __d('phkapa','Menu'); ?></a>
        </h2>
        <div class="block" id="admin-actions">
            <h5><?php echo __dn('phkapa','Process','Processes',2); ?></h5>
            <ul class="menu">
                <li><?php echo $this->Html->link(__d('phkapa','List %s', __dn('phkapa','Process','Processes',2)), array('controller' => 'processes', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__d('phkapa','Add %s', __d('phkapa','Process')), array('controller' => 'processes', 'action' => 'add')); ?> </li>
            </ul>
        </div>

    </div>

    <?php if (count($users) > 0) {
        ?>

        <table cellpadding="0" cellspacing="0">
            <?php
            $tableHeaders = $this->html->tableHeaders(array(
                $this->Paginator->sort('id',__d('phkapa','Id')), 
                $this->Paginator->sort('name',__d('phkapa','Name')), 
                $this->Paginator->sort('username',__d('phkapa','Username')), 
                $this->Paginator->sort('email',__d('phkapa','Email')), 
                $this->Paginator->sort('active',__d('phkapa','Active')), 
                array(__dn('phkapa','Action','Actions',2)=>array('class'=>'actions'))));
            echo '<thead class="ui-state-default"' . $tableHeaders . '</thead>';
            ?>

            <?php
            $i = 0;
            foreach ($users as $user):
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }

                
                ?>
                <tr<?php echo $class; ?>>
                    <td><?php echo $user['PhkapaUser']['id']; ?>&nbsp;</td>
                    <td><?php echo $user['PhkapaUser']['name']; ?>&nbsp;</td>
                    <td><?php echo $user['PhkapaUser']['username']; ?>&nbsp;</td>
                    <td><?php echo $user['PhkapaUser']['email']; ?>&nbsp;</td>
                    <td><?php echo $this->Utils->yesOrNo($user['PhkapaUser']['active']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__d('phkapa','View'), array('action' => 'view', $user['PhkapaUser']['id'])); ?>
                        <?php echo ' | ' . $this->Html->link(__d('phkapa','Edit'), array('action' => 'edit', $user['PhkapaUser']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php //echo '<tfoot class=\'dark\'>'.$tableHeaders.'</tfoot>';    ?>    </table>


        <p class="paging">
            <?php
            echo $this->Paginator->counter(array(
                'format' => __d('phkapa','Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
            ));
            ?>	</p>

        <div class="paging">
            <?php echo $this->Paginator->prev('<< ' . __d('phkapa','Previous'), array(), null, array('class' => 'disabled')); ?>
            | 	<?php echo $this->Paginator->numbers(); ?>
            |
            <?php echo $this->Paginator->Next(__d('phkapa','Next') . ' >>', array(), null, array('class' => 'disabled')); ?>
        </div>
        <?php
    } else {
        echo "Nao existe registos a apresentar!!!";
    }
    ?>
</div>
<div class="clear"></div>
