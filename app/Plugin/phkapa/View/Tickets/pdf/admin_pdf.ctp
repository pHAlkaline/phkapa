<html>
    <head>
        <meta http-equiv="CONTENT-TYPE" content="text/html; charset=utf-8">
        <title></title>
        <style type="text/css">
            <!--
            @page { size: 21.59cm 27.94cm; margin-left: 1.50cm; margin-right: 0.50cm; margin-top: 0.50cm; margin-bottom: 1.00cm }
            @page:first { }
            body { font-family: "Trebuchet MS, sans-serif";}
            P { margin-bottom: 0.21cm; direction: ltr; color: #000000; line-height: 100%; widows: 2; orphans: 2 }
            H1, .tableActions { margin-top: 0.07cm; margin-bottom: 0.07cm; border-top: none; border-bottom: 1px solid #00aeff; border-left: none; border-right: none; padding-top: 0cm; padding-bottom: 0.07cm; padding-left: 0cm; padding-right: 0cm; direction: ltr; color: #00aeff; line-height: 100%; widows: 2; orphans: 2 }
            H1.western { font-family: "Trebuchet MS, sans-serif", serif; font-size: 18pt; font-weight: normal }
            H1.cjk { font-size: 18pt }
            H1.ctl { "Trebuchet MS, sans-serif", font-size: 18pt }
            H2 { margin-top: 0.07cm; margin-bottom: 0.07cm; direction: ltr; color: #00aeff; line-height: 100%; widows: 2; orphans: 2; page-break-after: auto }
            H2.western { font-family: "Trebuchet MS, sans-serif", serif; font-size: 10pt }
            H2.cjk { font-weight: bold }
            H2.ctl { font-family: "Trebuchet MS, sans-serif", serif; font-weight: bold }
            A:link { so-language: zxx }
            A:visited { so-language: zxx }
            -->
        </style>
    </head>
    <body  text="#000000" dir="LTR">
        <h1 class="western" style="background: transparent; text-align: right;">
            <img src="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/app/webroot/img/PHKAPAlogo.png" name="PHKAPA logo" border="0">
        </h1>
        <h1 class="western" style="background: transparent; text-align: right;">
            Ticket Report
        </h1>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">

            <tbody>
                <tr valign="TOP">
                    <td width="12%">
                        <h2 class="western" align="RIGHT"><font color="#00aeff"><font face="Trebuchet MS, sans-serif"><?php echo __d('phkapa','ID'); ?>:
                            </font></font>
                        </h2>
                    </td>
                    <td width="33%">
                        <p style="margin-top: 0.07cm"><font face="Trebuchet MS, sans-serif"><?php echo $ticket['Ticket']['id']; ?></font></p>
                    </td>
                    <td width="12%">
                        <h2 class="western" align="RIGHT"><font color="#00aeff"><font face="Trebuchet MS, sans-serif"><?php echo __d('phkapa','Workflow'); ?>:
                            </font></font>
                        </h2>
                    </td>
                    <td width="33%">
                        <p style="margin-top: 0.07cm">
                            <font face="Trebuchet MS, sans-serif">
                            <?php echo $ticket['Workflow']['name']; ?>
                            </font>
                        </p>
                    </td>
                </tr>
                <tr valign="TOP">
                    <td >
                        <h2 class="western" align="RIGHT"><font color="#00aeff"><font face="Trebuchet MS, sans-serif"><?php echo __d('phkapa','Registar'); ?>:
                            </font></font>
                        </h2>
                    </td>
                    <td >
                        <p style="margin-top: 0.07cm"><font face="Trebuchet MS, sans-serif"><?php echo $ticket['Registar']['name']; ?></font></p>
                    </td>
                    <td >
                        <h2 class="western" align="RIGHT"><font color="#00aeff"><font face="Trebuchet MS, sans-serif"><?php echo __d('phkapa','Priority'); ?>:
                            </font></font>
                        </h2>
                    </td>
                    <td >
                        <p style="margin-top: 0.07cm">
                            <font face="Trebuchet MS, sans-serif">
                            <?php echo $ticket['Priority']['name']; ?>
                            </font>
                        </p>
                    </td>
                </tr>
                <tr valign="TOP">
                    <td >
                        <h2 class="western" align="RIGHT"><font color="#00aeff"><font face="Trebuchet MS, sans-serif"><?php echo __d('phkapa','Origin Date'); ?>: </font></font>
                        </h2>
                    </td>
                    <td >
                        <p style="margin-top: 0.07cm"><font face="Trebuchet MS, sans-serif">
                            <?php
                            if ($ticket['Ticket']['origin_date']) {
                                echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['origin_date']);
                            }
                            ?>
                            </font></p>
                    </td>
                    <td >
                        <h2 class="western" align="RIGHT"><font color="#00aeff"><font face="Trebuchet MS, sans-serif"><?php echo __d('phkapa','Type'); ?>:
                            </font></font>
                        </h2>
                    </td>
                    <td >
                        <p style="margin-top: 0.07cm"><font face="Trebuchet MS, sans-serif"><?php echo $ticket['Type']['name']; ?></font></p>
                    </td>
                </tr>
                <tr valign="TOP">
                    <td >
                        <h2 class="western" align="RIGHT"><font color="#00aeff"><font face="Trebuchet MS, sans-serif"><?php echo __d('phkapa','Origin'); ?>:
                            </font></font>
                        </h2>
                    </td>
                    <td >
                        <p style="margin-top: 0.07cm"><font face="Trebuchet MS, sans-serif"><?php echo $ticket['Origin']['name']; ?></font></p>
                    </td>
                    <td >
                        <h2 class="western" align="RIGHT"><font color="#00aeff"><font face="Trebuchet MS, sans-serif"><?php echo __d('phkapa','Process'); ?>:
                            </font></font>
                        </h2>
                    </td>
                    <td >
                        <p style="margin-top: 0.07cm">
                            <font face="Trebuchet MS, sans-serif">
                            <?php echo $ticket['Process']['name']; ?>
                            </font>
                        </p>
                    </td>
                </tr>
                <tr valign="TOP">
                    <td >
                        <h2 class="western" align="RIGHT"><font color="#00aeff"><font face="Trebuchet MS, sans-serif"><?php echo __d('phkapa','Activity'); ?>:
                            </font></font>
                        </h2>
                    </td>
                    <td >
                        <p style="margin-top: 0.07cm">
                            <font face="Trebuchet MS, sans-serif">
                            <?php echo $ticket['Activity']['name']; ?>
                            </font>
                        </p>
                    </td>
                    <td >
                        <h2 class="western" align="RIGHT"><font color="#00aeff"><font face="Trebuchet MS, sans-serif"><?php echo __d('phkapa','Category'); ?>:
                            </font></font>
                        </h2>
                    </td>
                    <td >
                        <p style="margin-top: 0.07cm">
                            <font face="Trebuchet MS, sans-serif">
                            <?php echo $ticket['Category']['name']; ?>
                            </font>
                        </p>
                    </td>
                </tr>
                <tr valign="TOP">
                    <td >
                        <h2 class="western" align="RIGHT"><font color="#00aeff"><font face="Trebuchet MS, sans-serif"><?php echo __d('phkapa','Supplier'); ?>:
                            </font></font>
                        </h2>
                    </td>
                    <td >
                        <p style="margin-top: 0.07cm">
                            <font face="Trebuchet MS, sans-serif">
                            <?php echo $ticket['Supplier']['name']; ?>
                            </font>
                        </p>
                    </td>
                    <td >
                        <h2 class="western" align="RIGHT"><font color="#00aeff"><font face="Trebuchet MS, sans-serif"><?php echo __d('phkapa','Approved'); ?>:
                            </font></font>
                        </h2>
                    </td>
                    <td >
                        <p style="margin-top: 0.07cm">
                            <font face="Trebuchet MS, sans-serif">
                            <?php echo $this->Utils->yesOrNo($ticket['Ticket']['approved']); ?>
                            </font>
                        </p>
                    </td>
                </tr>
                <tr valign="TOP">
                    <td >
                        <h2 class="western" align="RIGHT"><font color="#00aeff"><font face="Trebuchet MS, sans-serif"><?php echo __d('phkapa','Description'); ?>:
                            </font></font>
                        </h2>
                    </td>
                    <td colspan="3" >
                        <p style="margin-top: 0.07cm">
                            <font face="Trebuchet MS, sans-serif">
                            <?php echo $ticket['Ticket']['description'] . '<br/>' . $ticket['Ticket']['review_notes']; ?>
                            </font>
                        </p>
                    </td>
                </tr>
            </tbody></table>
        <p style="margin-top: 0.07cm; margin-bottom: 0.07cm"><br><br>
        </p>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">

            <thead>
                <tr valign="TOP">
                    <td width="12%">
                        <h2 class="western" align="RIGHT"><font face="Trebuchet MS, sans-serif"><?php echo __d('phkapa','Cause'); ?>:
                            </font></font
                        </h2>
                    </td>
                    <td width=87%">
                        <p style="margin-top: 0.07cm">
                            <font face="Trebuchet MS, sans-serif">
                            <?php echo $ticket['Cause']['name']; ?>
                            </font>
                        </p>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr valign="TOP">
                    <td >
                        <h2 class="western" align="RIGHT"><font color="#00aeff"><font face="Trebuchet MS, sans-serif"><?php echo __d('phkapa','Cause Notes'); ?>: </font></font>
                        </h2>
                    </td>
                    <td >
                        <p style="margin-top: 0.07cm">
                            <font face="Trebuchet MS, sans-serif">
                            <?php echo $ticket['Ticket']['cause_notes']; ?>
                            </font>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
        <p style="margin-top: 0.07cm; margin-bottom: 0.07cm"><br><br></p>
        <p>Actions</p>
        <?php $count=0; $page=1?>
            <?php if (!empty($ticket['Action'])){ ?>
        
        <?php foreach ($ticket['Action'] as $action): ?>
        <table class="tableActions" width="100%"  cellpadding="0" cellspacing="0" frame="VOID" rules="GROUPS">
            <tbody>
                <tr valign="TOP">
                    <td width="12%">
                        <h2 class="western" align="RIGHT"><font color="#00aeff"><font face="Trebuchet MS, sans-serif"><?php echo __d('phkapa','Action Type'); ?>: </font></font>
                        </h2>
                    </td>
                    <td colspan="3" >
                        <p style="margin-top: 0.07cm">
                            <font face="Trebuchet MS, sans-serif">
                            <?php echo $action['ActionType']['name']; ?>
                            </font>
                        </p>
                    </td>
                </tr>
                <tr valign="TOP">
                    <td width="12%">
                        <h2 class="western" align="RIGHT"><font color="#00aeff"><font face="Trebuchet MS, sans-serif"><?php echo __d('phkapa','Description'); ?>:
                            </font></font>
                        </h2>
                    </td>
                    <td colspan="3" >
                        <p style="margin-top: 0.07cm">
                            <font face="Trebuchet MS, sans-serif">
                            <?php echo $action['description']; ?>
                            
                            </font>
                        </p>
                    </td>
                </tr>
                <tr valign="TOP">
                    <td >
                        <h2 class="western" align="RIGHT"><font color="#00aeff"><font face="Trebuchet MS, sans-serif"><?php echo __d('phkapa','Effectiveness'); ?>:
                            </font></font>
                        </h2>
                    </td>
                    <td colspan="3" >
                        <p style="margin-top: 0.07cm"><font face="Trebuchet MS, sans-serif"><?php echo $action['ActionEffectiveness']['name']; ?></font></p>
                    </td>
                </tr>
                <tr valign="TOP">
                    <td >
                        <h2 class="western" align="RIGHT"><font color="#00aeff"><font face="Trebuchet MS, sans-serif"><?php echo __d('phkapa','Effectiveness Notes'); ?>: </font></font>
                        </h2>
                    </td>
                    <td colspan="3" >
                        <p style="margin-top: 0.07cm"><font face="Trebuchet MS, sans-serif"><?php echo $action['effectiveness_notes']; ?></font></p>
                    </td>
                </tr>
                <tr valign="TOP">
                    <td width="12%">
                        <h2 class="western" align="RIGHT"><font color="#00aeff"><font face="Trebuchet MS, sans-serif"><?php echo __d('phkapa','Created'); ?>:
                            </font></font>
                        </h2>
                    </td>
                    <td width="33%">
                        <p style="margin-top: 0.07cm"><font face="Trebuchet MS, sans-serif"><?php
                            if ($action['created']) {
                                echo $this->Time->format(Configure::read('dateFormatSimple'), $action['created']);
                            }
                            ?></font></p>
                    </td>
                    <td width="12%">
                        <h2 class="western" align="RIGHT"><font face="Trebuchet MS, sans-serif"><font color="#00aeff"><?php echo __d('phkapa','Closed'); ?></font>
                            </font>
                        </h2>
                    </td>
                    <td width="33%">
                        <p style="margin-top: 0.07cm"><font face="Trebuchet MS, sans-serif">
                            <?php
                            if ($action['closed']) {
                               echo $this->Utils->yesOrNo($action['closed']); 
                            }
                            ?>
                            </font>
                        </p>
                    </td>
                </tr>
            </tbody>

        </table>
       <p style="margin-top: 0.07cm; margin-bottom: 0.07cm"><br><br>
        </p>
        <p style="margin-top: 0.07cm; margin-bottom: 0.07cm"><br><br>
        </p>
        <?php $count++; ?>
        <?php if ($page>1 && ($count % 4 == 0)){ 
            $count=1;
            $top=0; 
            $page++; 
            ?>
        
            <p style="page-break-after: always; text-align: right;">
                <b><?php echo __d('phkapa','Continue'); ?>.....</b><br/>
                <b><?php echo __d('phkapa','Page'); ?>: <?php echo $page-1; ?></b>
             </p>
        <h1 class="western" style="background: transparent; text-align: right;">
            <?php echo __d('phkapa','Ticket Report'); ?>
        </h1>
             <br/><br/>
            <? }?>
             <?php if ($page==1 && ($count % 2 === 0)){ 
            $count=1;
            $top=0; 
            $page++; 
            
            ?>
             
             <p style="page-break-after: always; text-align: right;">
                <b><?php echo __d('phkapa','Continue'); ?>.....</b><br/>
                <b><?php echo __d('phkapa','Page'); ?>: <?php echo $page-1; ?></b>
             </p>
        <h1 class="western" style="background: transparent; text-align: right;">
            <?php echo __d('phkapa','Ticket Report'); ?>
        </h1>
             <br/><br/>
            <? }?>
        <?php endforeach; ?>
        <?php } else {  ?>
<p ><b><?php echo __d('phkapa','No records found!!!'); ?></b></p>
<?php } ?>
        

    </body>
</html>