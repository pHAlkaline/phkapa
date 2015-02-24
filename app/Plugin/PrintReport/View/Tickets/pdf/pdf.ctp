  <section class="content invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <?= $this->Html->image('PHKAPAlogo2.png', array('alt' => 'PHKAPA')); ?>
                                <?= $this->Html->image('yourlogo.png', array('class'=>'pull-right', 'alt' => 'YourLogoHere'));
                                ?>
                            </h2>
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">

                        <div class="col-sm-4 invoice-col">

                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">

                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <p class="lead pull-right"><?= __('Ticket Report'); ?></p>
                            <div class="clearfix"></div>
                            <small class="pull-right"><?= date(Configure::read('dateFormatSimple')); ?></small>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Table row -->
                    <div class="row">

                        <div class="col-xs-6">
                            <p class="lead"><?= __('Ticket Details'); ?></p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th class="col-xs-2"><?php echo __d('phkapa', 'ID'); ?></th>
                                        <td><?php echo $ticket['Ticket']['id']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __d('phkapa', 'Registar'); ?></th>
                                        <td><?php echo $ticket['Registar']['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __d('phkapa', 'Origin Date'); ?></th>
                                        <td><?php
                                if ($ticket['Ticket']['origin_date']) {
                                    echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['origin_date']);
                                }
                                ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __d('phkapa', 'Origin'); ?></th>
                                        <td><?php echo $ticket['Origin']['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __d('phkapa', 'Activity'); ?></th>
                                        <td><?php echo $ticket['Activity']['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __d('phkapa', 'Supplier'); ?></th>
                                        <td><?php echo $ticket['Supplier']['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __d('phkapa', 'Close Date'); ?></th>
                                        <td><?php
                                            if ($ticket['Ticket']['close_date']) {
                                                echo $this->Time->format(Configure::read('dateFormatSimple'), $ticket['Ticket']['close_date']);
                                            }
                                ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __d('phkapa', 'Closed By'); ?></th>
                                        <td><?php echo $ticket['CloseUser']['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __d('phkapa', 'Description'); ?></th>
                                        <td><?php echo $ticket['Ticket']['description'] . '<br/>' . $ticket['Ticket']['review_notes']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                        <div class="col-xs-6">
                            <p class="lead">&nbsp;</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th class="col-xs-2"><?php echo __d('phkapa', 'Workflow'); ?>:</th>
                                        <td><?php echo $ticket['Workflow']['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __d('phkapa', 'Priority'); ?></th>
                                        <td><?php echo $ticket['Priority']['name']; ?></td>
                                    </tr>

                                    <tr>
                                        <th><?php echo __d('phkapa', 'Safety'); ?></th>
                                        <td><?php echo $ticket['Safety']['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __d('phkapa', 'Type'); ?></th>
                                        <td><?php echo $ticket['Type']['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __d('phkapa', 'Process'); ?></th>
                                        <td><?php echo $ticket['Process']['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __d('phkapa', 'Category'); ?></th>
                                        <td><?php echo $ticket['Category']['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __d('phkapa', 'Approved'); ?></th>
                                        <td><?php echo $this->Utils->yesOrNo($ticket['Ticket']['approved']); ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __d('phkapa', 'Category'); ?></th>
                                        <td><?php echo $ticket['Category']['name']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->

                    </div><!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->

                        <div class="col-xs-6">
                            <p class="lead"><?php echo __d('phkapa', 'Cause'); ?></p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th class="col-xs-2"><?php echo __d('phkapa', 'Cause'); ?></th>
                                        <td> <?php echo $ticket['Cause']['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __d('phkapa', 'Cause Notes'); ?></th>
                                        <td> <?php echo $ticket['Ticket']['cause_notes']; ?></td>
                                    </tr>

                                </table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <!-- Table row -->
                    <div class="row">

                        <div class="col-xs-12 table-responsive">
                            <p class="lead"><?php echo __('Actions'); ?></p>
                            <?php if (!empty($ticket['Action'])) { ?>

                                <table class="table table-striped">
                                    <thead>



                                        <tr>
                                            <th><?php echo __d('phkapa', 'Action Type'); ?></th>
                                            <th><?php echo __d('phkapa', 'Description'); ?></th>
                                            <th><?php echo __d('phkapa', 'Effectiveness'); ?></th>
                                            <th><?php echo __d('phkapa', 'Effectiveness Notes'); ?></th>
                                            <th><?php echo __d('phkapa', 'Created'); ?></th>
                                            <th><?php echo __d('phkapa', 'Closed'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ticket['Action'] as $action): ?>
                                            <tr>
                                                <td><?php echo $action['ActionType']['name']; ?></td>
                                                <td><?php echo $action['description']; ?></td>
                                                <td><?php if (isset($action['ActionEffectiveness']['name'])) echo $action['ActionEffectiveness']['name']; ?></td>
                                                <td><?php echo $action['effectiveness_notes']; ?></td>
                                                <td><?php
                                            if ($action['created']) {
                                                echo $this->Time->format(Configure::read('dateFormatSimple'), $action['created']);
                                            }
                                            ?></td>
                                                <td><?php
                                            if ($action['closed']) {
                                                echo $this->Utils->yesOrNo($action['closed']);
                                            }
                                            ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>


                                </table>

                            <?php } else { ?>
                                <small><?php echo __d('phkapa', 'No records found!!!'); ?></small>
                            <?php } ?>
                        </div><!-- /.col -->
                    </div>

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-default pull-right" onclick="window.print();"><i class="fa fa-print"></i> Print</button>

                        </div>
                    </div>
                </section><!-- /.content -->