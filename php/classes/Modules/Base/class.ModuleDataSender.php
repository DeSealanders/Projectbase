<?php


class ModuleDataSender extends Singleton {

    public function __construct() {

    }

    public function saveModuleData($module, $itemId, $fields) {

        // Sanitize posted data
        $components = $module->getComponents();
        $dbFields = array();
        foreach($components as $component) {

            // See if matching post field is found
            if(isset($fields[$component->getId()])) {
                $dbFields[$component->getId()] = $component->saveData($fields[$component->getId()]);
            }
        }

        // Run update/insert query
        $query = new Query();
        $query->update('module_' . strtolower($module->getName()), $dbFields);
        $query->where('itemid = ' . $itemId);
        DatabaseManager::getInstance()->executeQuery($query);
    }

    public function deleteModuleItem($moduleName, $itemId) {
        $query = new Query();
        $query->delete('module_' . strtolower($moduleName));
        $query->where('itemid = ' . $itemId);
        DatabaseManager::getInstance()->executeQuery($query);
    }

    public function createNewItem($moduleName, $itemId) {
        $query = new Query();
        $query->insert('module_' . strtolower($moduleName), array('itemid' => $itemId));
        DatabaseManager::getInstance()->executeQuery($query);
    }
} 