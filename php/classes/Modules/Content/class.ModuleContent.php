<?php

class ModuleContent extends Module {

    public function __construct() {
        parent::__construct('Content');
        $this->setDescription('Manage content blocks displayed on the website');
        $this->addLayout('multi');
        $this->addComponent(new TextComponent('Title', 'title'));
        $this->addComponent(new EditorComponent('Content', 'content', false));
    }

} 