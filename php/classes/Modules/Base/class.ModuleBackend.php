<?php

class ModuleBackend {

    public function __construct($module) {
        $this->module = $module;
        $this->layouts = array(
            'single' => 'php/classes/Modules/Base/Layouts/single.Edit.php',
            'multi' => 'php/classes/Modules/Base/Layouts/multi.Edit.php',
        );
    }

    public function printHtml($layout, $itemid) {
        if(isset($this->layouts[$layout])) {
            if(file_exists($this->layouts[$layout])) {
                require($this->layouts[$layout]);
            }
            else {
                Logger::getInstance()->writeMessage('Could not find layout file: ' . $layout);
            }
        }
    }

    public function getComponents() {
        return $this->module->getComponents();
    }
} 