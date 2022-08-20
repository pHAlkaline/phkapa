<?php $this->Html->script('jquery-zoom', false); ?>

<div class="grid_16 actionsContainer">
     <div class="clear"></div>
        <?php if (Configure::read('Application.mode') == 'demo') { ?>
            <h2 id="page-heading"><?= __('Demonstration Users'); ?></h2>
            <div class="grid_16 actionsContainer">

                <table cellpadding="0" cellspacing="0">
                    <thead class="ui-state-default">
                        <tr>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        </tr>

                        <tr class="altrow">
                            <td>TOP USER&nbsp;</td>
                            <td>Quality Dep Manager&nbsp;</td>
                            <td>quality</td>
                            <td>qualityXX</td>

                        </tr>
                        <tr>
                            <td>MINOR USER&nbsp;</td>
                            <td>Administrative and Finance&nbsp;</td>
                            <td>aaf</td>
                            <td>aafXXXXXX</td>

                        </tr>
                        <tr class="altrow">
                            <td>MINOR USER&nbsp;</td>
                            <td>Comercial Department&nbsp;</td>
                            <td>cd</td>
                            <td>cdXXXXXXX</td>

                        </tr>
                        <tr>
                            <td>MINOR USER&nbsp;</td>
                            <td>Human Recources&nbsp;</td>
                            <td>hr</td>
                            <td>hrXXXXXXX</td>

                        </tr>
                        <tr class="altrow">
                            <td>MINOR USER&nbsp;</td>
                            <td>Managment and Client Support&nbsp;</td>
                            <td>macs</td>
                            <td>macsXXXXX</td>

                        </tr>
                        <tr>
                            <td>MINOR USER&nbsp;</td>
                            <td>Management Control and Businees&nbsp;</td>
                            <td>mcb</td>
                            <td>mcbXXXXXX</td>


                        <tr>
                            <td>MINOR USER&nbsp;</td>
                            <td>Reception&nbsp;</td>
                            <td>rec</td>
                            <td>recXXXXXX</td>

                        </tr>
                    </tbody></table>


                <div class="clear"></div>

                <div class="clear"></div>
            </div>
        <?php } ?>
        <div class="grid_16">
            <h2 id="page-heading"><?php echo __('Start Session'); ?></h2>
            <div class="form ui-widget">
                <?php echo $this->Form->create('User', array('url' => '/users/login')); ?>
                <fieldset class="ui-corner-all ui-widget-content" >
                    <?php
                    echo $this->Form->input('username', array('maxlength' => '40', 'label' => __('Username')));
                    echo $this->Form->input('password', array('maxlength' => '40', 'label' => __('Password')));
                    echo $this->Form->input('language', array('options' => Configure::read('Language.list'), 'empty' => '(choose one)'));
                    
                    ?>
                    <div class="input">
                    <label></label>
                    <div><?php echo __('Time Zone');?>&nbsp;<?php echo Configure::read('Config.timezone'); ?></div>
                    </div>
                    <?php echo $this->Form->submit(__('Start Session')); ?>
                </fieldset>
                <?php echo $this->Form->end(); ?>
            </div>

        </div>
       
    <div class="clear"></div>

</div>