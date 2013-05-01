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
<table cellpadding="0" cellspacing="0">
    <?php
    $tableHeaders = $this->html->tableHeaders(
            array(iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Id')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Ticket Parent')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Workflow')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Priority')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Type')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Origin')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Origin Date')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Process')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Activity')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Category')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Supplier')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Approved')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Review Notes')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Description')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Cause')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Cause Notes')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Close Date')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Modified')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Created')),
                '',
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Action Type')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Description')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Deadline')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Expiry')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Closed')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Close Date')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Effectiveness')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Effectiveness Notes')),
                '',
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Action Type')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Description')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Deadline')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Expiry')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Closed')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Close Date')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Effectiveness')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Effectiveness Notes')),
                '',
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Action Type')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Description')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Deadline')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Expiry')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Closed')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Close Date')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Effectiveness')),
                iconv("UTF-8", "ISO-8859-1//TRANSLIT", __d('phkapa','Effectiveness Notes'))
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
            
            <td>
                <?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Workflow']['name']); ?>
            </td>
            <td>
                <?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Priority']['name']); ?>
            </td>
            <td>
                <?php if (isset($ticket['Ticket']['origin_date'])) echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['origin_date']); ?>&nbsp;
            </td>
            <td>
                <?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Type']['name']); ?>
            </td>
            <td>
                <?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Origin']['name']); ?>
            </td>
            <td>
                <?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Process']['name']); ?>
            </td>
            <td>
                <?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIt", $ticket['Activity']['name']); ?>
            </td>
            <td>
                <?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Category']['name']); ?>
            </td>
            <td>
                <?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Supplier']['name']); ?>
            </td>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $this->Utils->yesOrNo($ticket['Ticket']['approved'])); ?>&nbsp;</td>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Ticket']['review_notes']); ?>&nbsp;</td>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Ticket']['description']); ?>&nbsp;</td>
            <td>
                <?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Cause']['name']); ?>
            </td>
            <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $ticket['Ticket']['cause_notes']); ?>&nbsp;</td>
            <td><?php if (isset($ticket['Ticket']['close_date'])) echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['close_date']); ?>&nbsp;</td>
            <td><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['modified']); ?>&nbsp;</td>
            <td><?php echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['created']); ?>&nbsp;</td>

            <?php
            if (count($ticket['Action']) > 0) {
                $result = Set::sort($ticket['Action'], '{n}.action_type_id', 'asc');
                //debug($result);
                $xDrawn = 0;
                for ($i = 0; $i < count($result); $i++) {

                    $xPos = $result[$i]['action_type_id'];
                    $zCount=($xPos*9)-9-$xDrawn;

                    for ($z = 0; $z < $zCount; $z++) {
                            echo '<td>&nbsp;</td>';
                    }
                    
                    $xDrawn=($xPos*9);
                    

                    $expiry = '';
                    $expiry = strtotime(date($result[$i]['created']) . " +" . $result[$i]['deadline'] . " day");
                    ?>
                    <td>&nbsp;</td>
                    <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $result[$i]['ActionType']['name']); ?></td>
                    <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $result[$i]['description']); ?></td>
                    <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $result[$i]['deadline']); ?></td>
                    <td><?php if ($expiry) echo $this->Time->format(Configure::read('dateFormatSimple'), $expiry); ?></td>
                    <td><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $this->Utils->yesOrNo($result[$i]['closed'])); ?></td>
                    <td><?php if (isset($result[$i]['close_date'])) echo $this->Time->format(Configure::read('dateFormatSimple'), $result[$i]['close_date']); ?></td>
                    <td><?php if (isset($result[$i]['ActionEffectiveness']['name']))
                echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", $result[$i]['ActionEffectiveness']['name']); ?></td>
                    <td><?php echo $result[$i]['effectiveness_notes']; ?></td>
                    <?php
                }
            }
            ?>
        </tr>
    <?php endforeach; ?>
    <?php //echo '<tfoot class=\'dark\'>'.$tableHeaders.'</tfoot>';   ?>    </table>
