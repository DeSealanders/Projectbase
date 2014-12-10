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

    public function hasTable($moduleName) {
        $query = new Query();
        $query->select('1');
        $query->from('module_' . strtolower($moduleName));
        $hasData = DatabaseManager::getInstance()->executeQuery($query, false, true);
        if($hasData) {
            return true;
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

} 