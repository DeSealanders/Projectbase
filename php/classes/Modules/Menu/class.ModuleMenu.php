<?php

class ModuleMenu extends Module {

    public function __construct() {
        parent::__construct('Menu');
        $this->setDescription('Manage the menu of the website');
        $this->addLayout('single');
        $this->addComponent(new TextComponent('Title', 'title'));
        $this->addComponent(new OneToOneComponent('Page', 'page', 'pages', 'title'));
    }
} 