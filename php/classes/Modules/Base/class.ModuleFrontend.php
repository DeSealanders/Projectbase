<?php

class ModuleFrontend {

    private $layouts;
    private $module;

    public function __construct($module) {
        $this->module = $module;
        $this->layouts = array();
    }

    public function addLayout($layout) {
        $layoutPath = $this->module->getModulePath() . 'Layouts/' . $layout . '.' . $this->module->getName() . '.php';
        if(file_exists($layoutPath)) {
            $this->layouts[$layout] = $layoutPath;
        }
        else {
            Logger::getInstance()->writeMessage('Could not find layout "' . $layout . '" in ' . $layoutPath);
        }
    }

    public function printHtml($layout, $itemid) {
        if(isset($this->layouts[$layout])) {
            require $this->layouts[$layout];
        }
        else {
            Logger::getInstance()->writeMessage('Could not find layout "' . $layout . '"');
        }
    }

    public function getRecords() {
        return $this->module->getRecords();
    }

    public function getLayouts() {
        return $this->layouts;
    }

} 