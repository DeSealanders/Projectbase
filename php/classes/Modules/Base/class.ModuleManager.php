<?php

class ModuleManager extends Singleton {

    private $modules;

    public function __construct() {
        $this->modules = array();
    }

    public function getModule($moduleName) {
        if(isset($this->modules[strtolower($moduleName)])) {
            return $this->modules[strtolower($moduleName)];
        }
        else {
            return false;
        }
    }

    public function loadModules() {
        $moduleNames = ModulesConfig::getInstance()->getModuleNames();
        foreach($moduleNames as $moduleName) {
            $this->loadModule($moduleName);
        }
    }

    public function isModule($moduleName) {
        $moduleClassName = 'Module' . $moduleName;
        $moduleNames = ModulesConfig::getInstance()->getModuleNames();
        if(in_array(strtolower($moduleName), $moduleNames)) {
            if(class_exists($moduleClassName)) {
                return $moduleName;
            }
        }
    }

    public function getModuleList() {
        $moduleList = array();
        $moduleNames = ModulesConfig::getInstance()->getModuleNames();
        foreach($moduleNames as $moduleName) {
            $moduleClassName = 'Module' . $moduleName;
            if(class_exists($moduleClassName)) {
                $moduleList[] = $moduleName;
            }
        }
        return $moduleList;
    }

    public function loadModule($moduleName) {

        // Create a classname for the module
        $moduleClassName = 'Module' . $moduleName;

        // Create a module from the classname if it exists
        if(class_exists($moduleClassName)) {
            $module = new $moduleClassName;
            // Get data and load for the module (if it exists)
            if(ModuleDataProvider::getInstance()->hasTable($moduleName)) {
                $records = ModuleDataProvider::getInstance()->getModuleData($moduleName);
                $module->setRecords($records);
            }

            // Create table if it doesn't exist
            else {
                $moduleColumns = $module->getComponentNames();
                ModuleDataProvider::getInstance()->createTable($moduleName, $moduleColumns);
                $module->setRecords(false);
            }

            // Add module to the module list
            $this->modules[strtolower($moduleName)] = $module;
        }
        else {
            Logger::getInstance()->writeMessage('No class found for module "' . $moduleName . '"');
        }
    }

} 