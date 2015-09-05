<?php

App::uses('SchemaShell', 'Console/Command');
App::uses('File', 'Utility');
App::uses('Folder', 'Utility');
App::uses('CakeSchema', 'Model');

class SchemaInstallShell extends SchemaShell {

    public function __construct($stdout = null, $stderr = null, $stdin = null) {
        // This will cause all Shell outputs, eg. from $this->out(), to be written to
        // TMP.'shell.out'
        $stdout = new ConsoleOutput('file://' . TMP . 'SchemaInstallShell.out');

        // You can do the same for stderr too if you wish
        $stderr = new ConsoleOutput('file://'.TMP.'SchemaInstallShell.err');

        parent::__construct($stdout, $stderr, $stdin);
    }

    
    public function install() {
        list($Schema, $table) = $this->_loadSchema();
        $this->_install($Schema, $table);
    }

    protected function _install(CakeSchema $Schema, $table = null) {
        $db = ConnectionManager::getDataSource($this->Schema->connection);


        if (!$table) {
            foreach ($Schema->tables as $table => $fields) {
                $create[$table] = $db->createSchema($Schema, $table);
            }
        } elseif (isset($Schema->tables[$table])) {
            $create[$table] = $db->createSchema($Schema, $table);
        }
        if (empty($create)) {
            $this->out(__d('cake_console', 'Schema is up to date.'));
            $this->_stop();
        }

        $this->_run($create, 'create', $Schema);
    }

    public function check() {
        $options['models'] = false;
        list($Schema, $table) = $this->_loadSchema();
        foreach ($Schema->tables as $key => $value) {
            $tables[] = $key;
        }

        return $tables;
    }

}
