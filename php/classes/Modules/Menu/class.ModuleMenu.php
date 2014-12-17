<?php

class ModuleMenu extends Module {

    public function __construct() {
        parent::__construct('Menu');
        $this->addLayout('single');
        $this->addComponent(new TextComponent('Title', 'title'));
        $this->addComponent(new TextComponent('Link', 'link'));
    }
} 