<?php

class OneToOneComponent extends ModuleComponent {

    private $label;
    private $id;
    private $options;

    public function __construct($label, $id = false, $moduleName, $componentName, $showInMulti = true) {
        parent::__construct($showInMulti);
        $this->label = $label;
        if($id) {
            $this->id = $id;
        }
        else {
            $this->id = $label;
        }
        $this->options = $this->getComponentValues($moduleName, $componentName);
    }

    public function getId() {
        return $this->id;
    }

    public function getFormComponent($value) {
        return new Dropdown($this->label, $this->id, $this->options, $value);
    }

    public function getValue($value) {
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