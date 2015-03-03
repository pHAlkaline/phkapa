<?php $this->Html->script('jquery-zoom', false); ?>

<div class="grid_16 actionsContainer">
    <?php if (AuthComponent::user('id')) { ?>
        <div class="grid_16" style="text-align:center" id="PHKAPAHome">
            <?php echo $this->Html->image('yourlogo.png', array('style' => 'float: right; height: 35px;', 'alt' => 'YourLogoHere')); ?>
            <div>

                <?php echo $this->Html->link($this->Html->image('PHKAPA_big.png', array('alt' => 'PHKAPA')), Router::url('/phkapa', true), array('style' => '', 'class' => 'zoom logo2', 'target' => '_self', 'escape' => false)); ?>
            </div>
            <!--div id="zoomContainer">
                
                

            </div-->

        </div>
    <?php } else { ?>
        <div class="grid_16">
            <h2 id="page-heading"><?php echo __('Start Session'); ?></h2>
            <div class="form ui-widget">
                <?php echo $this->Form->create('User', array('url' => '/users/login')); ?>
                <fieldset class="ui-corner-all ui-widget-content" >
                    <?php
                    echo $this->Form->input('username', array('maxlength' => '8', 'label' => __('Username')));
                    echo $this->Form->input('password', array('maxlength' => '8', 'label' => __('Password')));
                    echo $this->Form->input('language', array('options' => Configure::read('Language.list'), 'empty' => '(choose one)'));
                    
                    ?>
                    <div class="input">
                    <label></label>
                    <div><?php echo __('Time Zone');?>&nbsp;<?php echo Configure::read('Config.timezone'); ?></div>
                    </div>

                </fieldset>
                <?php echo $this->Form->end(__('Start Session')); ?>
            </div>

        </div>
        <div class="clear"></div>
        <?php if (Configure::read('Application.mode') == 'demo') { ?>

            <h2 id="page-heading">Choose User</h2>
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
                            <td>quality&nbsp;</td>
                            <td>quality&nbsp;</td>

                        </tr>
                        <tr>
                            <td>MINOR USER&nbsp;</td>
                            <td>Administrative and Finance&nbsp;</td>
                            <td>aaf&nbsp;</td>
                            <td>aaf&nbsp;</td>

                        </tr>
                        <tr class="altrow">
                            <td>MINOR USER&nbsp;</td>
                            <td>Comercial Department&nbsp;</td>
                            <td>cd&nbsp;</td>
                            <td>cd&nbsp;</td>

                        </tr>
                        <tr>
                            <td>MINOR USER&nbsp;</td>
                            <td>Human Recources&nbsp;</td>
                            <td>hr&nbsp;</td>
                            <td>hr&nbsp;</td>

                        </tr>
                        <tr class="altrow">
                            <td>MINOR USER&nbsp;</td>
                            <td>Managment and Client Support&nbsp;</td>
                            <td>macs&nbsp;</td>
                            <td>macs&nbsp;</td>

                        </tr>
                        <tr>
                            <td>MINOR USER&nbsp;</td>
                            <td>Management Control and Businees&nbsp;</td>
                            <td>mcb&nbsp;</td>
                            <td>mcb&nbsp;</td>


                        <tr>
                            <td>MINOR USER&nbsp;</td>
                            <td>Reception&nbsp;</td>
                            <td>rec&nbsp;</td>
                            <td>rec&nbsp;</td>

                        </tr>
                    </tbody></table>


                <div class="clear"></div>

                <div class="clear"></div>
            </div>
        <?php } ?>
    <?php } ?>
    <div class="clear"></div>

</div>