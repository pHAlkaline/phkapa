<STYLE type="text/css">
    thead {
        border-width: 0.5pt;
        border: solid;
    }
    td{
        border-width: 0.5pt;
        border: solid;
    }
    thead{
        font-weight: bolder;
    }

</STYLE>
<table><tr><td> </td></tr><tr><td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'List %s', __dn('phkapa', 'Ticket', 'Tickets', 2))); ?></td></tr></table>
<table cellpadding="0" cellspacing="0">
    <?php
    $tableHeaders = $this->html->tableHeaders(
            array(iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Id')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Ticket Parent')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Registar')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Workflow')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Priority')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Safety')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Origin Date')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Type')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Origin')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Process')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Activity')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Category')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Supplier')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Approved')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Review Notes')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Description')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Cause')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Cause Notes')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Close Date')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Closed By')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Last Modification By')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Modified')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Created')),
            ));
    echo '<thead>' . $tableHeaders . '</thead>';
    ?>
    <?php
    $i = 0;
    foreach ($tickets as $ticket):
        $class = null;
        if ($i++ % 2 == 0) {
            $class = ' class="altrow"';
        }
        ?>
        <tr<?php echo $class; ?>>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Ticket']['id']); ?></td>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Ticket']['ticket_parent']); ?></td>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Registar']['name']); ?></td>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Workflow']['name']); ?></td>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Priority']['name']); ?></td>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Safety']['name']); ?></td>
            <td><?php if (isset($ticket['Ticket']['origin_date'])) echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['origin_date']); ?>&nbsp;</td>            
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Type']['name']); ?></td>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Origin']['name']); ?></td>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Process']['name']); ?></td>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIt", $ticket['Activity']['name']); ?></td>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Category']['name']); ?></td>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Supplier']['name']); ?></td>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $this->Utils->yesOrNo($ticket['Ticket']['approved'])); ?>&nbsp;</td>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Ticket']['review_notes']); ?>&nbsp;</td>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Ticket']['description']); ?>&nbsp;</td>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Cause']['name']); ?></td>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Ticket']['cause_notes']); ?>&nbsp;</td>
            <td><?php if (isset($ticket['Ticket']['close_date'])) echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['close_date']); ?>&nbsp;</td>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['CloseUser']['name']); ?></td>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['ModifiedUser']['name']); ?></td>
            <td><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['modified']); ?>&nbsp;</td>
            <td><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['created']); ?>&nbsp;</td>


        </tr>
    <?php endforeach; ?>
    <?php //echo '<tfoot class=\'dark\'>'.$tableHeaders.'</tfoot>';     ?>    
</table>
<table>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'List %s', __dn('phkapa', 'Action', 'Actions', 2))); ?></td>
    </tr>
</table>
<table>
    <?php
    $tableHeaders = $this->html->tableHeaders(
            array(iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Id')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Ticket')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Action Type')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Description')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Deadline')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Expiry')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Closed')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Closed By')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Close Date')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Effectiveness')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Verified By')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Effectiveness Notes')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Last Modification By')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Modified')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa', 'Created')),
            ));
    echo '<thead>' . $tableHeaders . '</thead>';
    ?>
    <?php
    $i = 0;
    foreach ($tickets as $ticket):
         ?>
        <?php
        if (count($ticket['Action']) > 0) {
            $result = Set::sort($ticket['Action'], '{n}.action_type_id', 'asc');
            foreach ($result as $action):
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                $expiry = '';
                $expiry = strtotime(date($action['created']) . " +" . $action['deadline'] . " day");
                ?>
                <tr>
                    <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $action['id']); ?></td>
                    <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $action['ticket_id']); ?></td>
                    <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $action['ActionType']['name']); ?></td>
                    <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $action['description']); ?></td>
                    <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $action['deadline']); ?></td>
                    <td><?php if ($expiry) echo $this->Time->format(Configure::read('dateFormatSimple'), $expiry); ?></td>
                    <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $this->Utils->yesOrNo($action['closed'])); ?></td>
                    <td>
                        <?php
                        if (isset($action['CloseUser']['name'])) {
                            echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $action['CloseUser']['name']);
                        }
                        ?>
                    </td>
                    <td><?php if (isset($action['close_date'])) echo $this->Time->format(Configure::read('dateFormatSimple'), $action['close_date']); ?></td>
                    <td>
                        <?php
                        if (isset($action['ActionEffectiveness']['name'])) {
                            echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $action['ActionEffectiveness']['name']);
                        }
                        ?>
                    </td>
                    <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $action['VerifyUser']['name']); ?></td>
                    <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $action['effectiveness_notes']); ?></td>
                    <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $action['ModifiedUser']['name']); ?></td>
                    <td><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $action['modified']); ?>&nbsp;</td>
                    <td><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $action['created']); ?>&nbsp;</td>



                </tr>
            <?php endforeach; ?>
        <?php } ?>
<?php endforeach; ?>

</table>

