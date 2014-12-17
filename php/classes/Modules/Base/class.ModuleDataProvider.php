<?php


class ModuleDataProvider extends Singleton {

    public function __construct() {

    }

    public function getModuleData($moduleName) {
        $query = new Query();
        $query->select('*');
        $query->from('module_' . strtolower($moduleName));
        $query->orderBy('itemid');
        $records = DatabaseManager::getInstance()->executeQuery($query);
        return $records;
    }

    public function getColumns($moduleName) {
        $query = new Query();
        $query->describe('module_' . strtolower($moduleName));
        $columns = DatabaseManager::getInstance()->executeQuery($query, false, true);
        if($columns) {
            return $columns;
        }
        else {
            return false;
        }
    }

    public function createTable($moduleName, $moduleColumns) {
        $defaultColumns = array(
            'id' => 'INT(10) AUTO_INCREMENT PRIMARY KEY',
            'created' => 'DATETIME DEFAULT CURRENT_TIMESTAMP',
            'itemid' => 'INT(10)'
        );
        $columns = array_merge($defaultColumns, $moduleColumns);
        $query = new Query();
        $query->create('module_' . strtolower($moduleName), $columns);
        DatabaseManager::getInstance()->executeQuery($query);
    }

    public function alterModTable($moduleName, $modColumns, $colums) {

        // Create comparable array (fieldname as key and datatype as value)
        $colums = array_slice($colums, 3);
        $dbColumns = array();
        foreach($colums as $column) {
            $dbColumns[$column['Field']] = strtoupper($column['Type']);
        }

        // Calculate differences between module and db items
        $added = array_diff_assoc($modColumns, $dbColumns);
        $removed = array_diff_assoc($dbColumns, $modColumns);

        // Alter table if needed
        if(!empty($added) || !empty($removed)) {
            $query = new Query();
            $query->alter('module_' . strtolower($moduleName), array(
                    'add' => $added,
                    'remove' => $removed
                ));
            DatabaseManager::getInstance()->executeQuery($query);
        }
    }

    public function getNewItemId($moduleName) {
        $query = new Query();
        $query->select('MAX(itemid) + 1 as itemid');
        $query->from('module_' . strtolower($moduleName));
        $result = DatabaseManager::getInstance()->executeQuery($query);
        if($result[0]['itemid'] == 0) {
            return 1;
        }
        else {
            return $result[0]['itemid'];
        }
    }
} 