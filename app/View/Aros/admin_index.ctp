<h2 id="page-heading"><?php echo __n('Aro','Aros',2); ?></h2>
<div class="grid_16 actionsContainer">
    <div class="grid_4" id="actions">	
        			
            <h2>
                <a href="#" id="toggle-admin-actions"><?php echo __('Menu'); ?></a>
            </h2>
            <div class="block" id="admin-actions">			
                <h5><?php echo __('Actions'); ?></h5>
                <ul class="menu">
                    <li><?php echo $this->Html->link(__('Add %s', __('Aro')), array('action' => 'add')); ?></li>
                </ul>




            </div>
        
    </div>



    <table cellpadding="0" cellspacing="0">
        <?php $tableHeaders = $this->Html->tableHeaders(
                array( __('Group / User'), __('Actions')),
                null,
                array('width'=>'80%')
                
                );
        echo '<thead class="ui-state-default"' . $tableHeaders . '</thead>'; ?>

        <?php
        $i = 0;
        foreach ($nodelist as $key => $value) :

            $class = null;
            $classBlue = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            
            if (in_array($key,$groupNodeList)){
                $classBlue =' class="blue"';
            }

            $editurl = $this->Html->link(__('Edit'), array('action' => 'edit', $key));
            $upurl = $this->Html->link(__('Up'), array('action' => 'moveup', $key));
            $downurl = $this->Html->link(__('Down'), array('action' => 'movedown', $key));
            $deleteurl = $this->Html->link(__('Delete'), array('action' => 'delete', $key), null, __('Are you sure you want to delete # %s?', $value) .'. '.__('This will also delete childs!!'))
            ?>
            <tr <?php echo $class; ?> >
                <td <?php echo $classBlue; ?> ><?php echo $value; ?>&nbsp;</td>
                <td class="actions"><?php if ($key > 3) echo $editurl . ' | ' . $upurl . ' | ' . $downurl . ' | ' . $deleteurl; ?>&nbsp;</td>
            </tr>
            <?php endforeach; ?>
    </table>



</div>
<div class="clear"></div>

