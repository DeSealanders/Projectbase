<?php


class ModuleDataSender extends Singleton {

    public function __construct() {

    }

    public function saveModuleData($module, $itemId, $fields, $files) {

        // Sanitize posted data
        $components = $module->getComponents();
        $dbFields = array();
        foreach($components as $component) {

            if(get_class($component) == 'SlugComponent') {
                if($component->getComponentNames()) {
                    $compValues = array();
                    foreach($component->getComponentNames() as $compName) {
                        if(isset($dbFields[$compName])) {
                            $compValues[] = $dbFields[$compName];
                        }
                    }
                }
                if(!empty($compValues)) {
                    $dbFields[$component->getId()] = $component->saveData($compValues);
                }
            }

            // See if matching post field is found
            else if(isset($fields[$component->getId()])) {
                $dbFields[$component->getId()] = $component->saveData($fields[$component->getId()]);
            }
            else if(isset($files[$component->getId()])) {
                $dbFields[$component->getId()] = $component->saveData($files[$component->getId()]);
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