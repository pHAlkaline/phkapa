<h2 class="grid_16" id="page-heading"><?php echo $title_for_step; ?></h2>
<div class="grid_16 actionsContainer">



    <div class="database form">
        <?php echo $this->Form->create(false, array('url' => array('controller' => 'install', 'action' => 'database')));
        ?>
        <fieldset class="ui-corner-all ui-widget-content" >
            <legend><?php echo __d('install', 'Setup database connection'); ?></legend>
            <?php
            echo $this->Form->input('datasource', array(
                'label' => 'Datasource',
                'default' => 'Database/Mysql',
                'empty' => false,
                'options' => array(
                    'Database/Mysql' => 'mysql',
                    'Database/Sqlite' => 'sqlite',
                    'Database/Postgres' => 'postgres',
                    'Database/Sqlserver' => 'mssql',
                ),
            ));
            echo $this->Form->input('host', array('label' => 'Host', 'default' => 'localhost'));
            echo $this->Form->input('login', array('label' => 'User / Login', 'default' => 'root'));
            echo $this->Form->input('password', array('label' => 'Password'));
            echo $this->Form->input('database', array('label' => 'Name', 'default' => 'phkapa'));
            echo $this->Form->input('encoding', array('label' => 'Encoding', 'default' => 'utf8'));
            //echo $this->Form->input('prefix', array('label' => 'Prefix'));
            echo $this->Form->input('port', array('label' => 'Port (leave blank if unknown)'));
            echo $this->Form->submit(__('Submit'));
            ?>
        </fieldset>
        <?php echo $this->Form->end(); ?>
    </div>

</div>
<div class="clear"></div>