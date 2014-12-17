<?php


class ModuleDataSender extends Singleton {

    public function __construct() {

    }

    public function saveModuleData($module, $itemId, $fields) {

        // Sanitize posted data
        $components = $module->getComponents();
        $dbFields = array();
        foreach($components as $compName => $component) {

            // Only allow posting of component fields
            if(isset($fields[$component->getId()])) {
                $dbFields[$component->getId()] = htmlentities($fields[$component->getId()]);
            }

            // Fix fields for checkboxes
            if($component instanceof CheckboxComponent) {
                $dbFields[$component->getId()] = $this->setCheckboxFields($component, $fields);
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

    private function setCheckboxFields($component, $fields) {

        // Set the correct data for checkboxes
        $checked = array();
        $options = array_keys($component->getOptions());
        foreach($options as $option) {
            if(isset($fields[$option])) {
                if($fields[$option] == 'checked') {
                    $checked[] = $option;
                }
            }
        }

        return implode(',', $checked);
    }
} 