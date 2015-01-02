<?php

class OneToManyComponent extends ModuleComponent {

    private $options;

    public function __construct($label, $id = false, $moduleName, $componentName, $showInMulti = true) {
        parent::__construct($label, $id, $showInMulti);
        $this->options = $this->getComponentValues($moduleName, $componentName);
    }

    public function getFormComponent($value) {
        return new Checkbox($this->label, $this->id, $this->options, $value);
    }

    public function getPreview($value) {
        if(isset($this->options[$value])) {
            return $this->options[$value];
        }
        else {
            return $value;
        }
    }

    private function getComponentValues($moduleName, $componentName) {
        ModuleManager::getInstance()->loadModule($moduleName);
        $module = ModuleManager::getInstance()->getModule($moduleName);
        $records = $module->getRecords();
        $compValues = array();
        foreach($records as $record) {
            if(isset($record[$componentName])) {
                $compValues[$record['itemid']] = $record[$componentName];
            }
        }
        return $compValues;
    }
} 