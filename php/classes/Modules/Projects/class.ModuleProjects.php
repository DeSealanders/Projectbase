<?php

class ModuleProjects extends Module {

    public function __construct() {
        parent::__construct('Projects');
        $this->addLayout('single');
        $this->addComponent(new TextComponent('Name', 'name'));
        $this->addComponent(new TextComponent('Description', 'description'));
    }

} 