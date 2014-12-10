<?php

class ModuleBackend {

    public function __construct($module) {
        $this->module = $module;
        $this->layouts = array(
            'single' => '/layouts/single.Edit.php',
            'multi' => '/layouts/multi.Edit.php',
        );
    }

    public function printHtml($layout, $itemid) {
        if(isset($this->layouts[$layout])) {
            require($this->layouts[$layout]);
        }
    }

    public function getComponents() {
        return $this->module->getComponents();
    }

} 