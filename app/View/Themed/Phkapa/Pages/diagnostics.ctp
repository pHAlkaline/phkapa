<?php $this->Html->script('jquery-zoom', false); ?>
<h2>&nbsp;</h2>
<div class="grid_16 actionsContainer">
    
            <h2 class="">
                <a href="#" id="toggle-admin-actions"><?php echo __('Diagnostics'); ?></a>
            </h2>
            <div class="" id="">
                <div>

                    <?php
                    if (Configure::read('debug') > 0):
                        Debugger::checkSecurityKeys();
                    endif;
                    ?>
                    <p>
                        <?php
                        if (is_writable(TMP)):
                            echo '<span class="notice success">';
                            echo __('Your tmp directory is writable.');
                            echo '</span>';
                        else:
                            echo '<span class="notice">';
                            echo __('Your tmp directory is NOT writable.');
                            echo '</span>';
                        endif;
                        ?>
                    </p>
                    <p>
                        <?php
                        $settings = Cache::settings();
                        if (!empty($settings)):
                            echo '<span class="notice success">';
                            echo __('The %s is being used for caching. To change the config edit APP/config/core.php ', '<em>' . $settings['engine'] . 'Engine</em>');
                            echo '</span>';
                        else:
                            echo '<span class="notice">';
                            __('Your cache is NOT working. Please check the settings in APP/config/core.php');
                            echo '</span>';
                        endif;
                        ?>
                    </p>

                    <p>
                        <?php
                        $filePresent = null;
                        if (file_exists(APP . 'Config' . DS . 'database.php')):
                            echo '<span class="notice success">';
                            echo __('Your database configuration file is present.');
                            $filePresent = true;
                            echo '</span>';
                        else:
                            echo '<span class="notice">';
                            echo __('Your database configuration file is NOT present.');
                            echo '<br/>';
                            echo __('Rename config/database.php.default to config/database.php');
                            echo '</span>';
                        endif;
                        ?>
                    </p>
                    
                    <?php
                    if (isset($filePresent)):
                        App::uses('ConnectionManager', 'Model');
                        try {
                            $connected = ConnectionManager::getDataSource('default');
                        } catch (Exception $connectionError) {
                            $connected = false;
                        }
                        ?>
                        <p>
                            <?php
                            if ($connected && $connected->isConnected()):
                                echo '<span class="notice success">';
                                echo __('pHKapa is able to connect to the database.');
                                echo '</span>';
                            else:
                                echo '<span class="notice">';
                                echo __('pHKapa is NOT able to connect to the database.');
                                echo '<br /><br />';
                                echo $connectionError->getMessage();
                                echo '</span>';
                            endif;
                            ?>
                        </p>
                    <?php endif; ?>

                    <?php /*
                      App::import('Model', 'SapManager', array('file' => 'sap_manager.php'));
                      $sap = new SapManager();
                      ?>
                      <p>
                      <?php
                      if ($sap->sapLogin('Production')):
                      echo '<span class="notice success">';
                      __('Application is able to connect to SAP.');
                      echo '</span>';
                      else:
                      echo '<span class="notice">';
                      __('Application is NOT able to connect to SAP.');
                      echo '</span>';
                      endif;
                      ?>
                      </p>

                      <?php */ ?>
                </div>
                <div class="clear"></div>



            </div>
</div>
   
