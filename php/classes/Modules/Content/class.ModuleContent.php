<?php

class ModuleContent extends Module {

    public function __construct() {
        parent::__construct('Content');
        $this->addLayout('multi');
        $this->addComponent(new TextComponent('Title', 'title'));
        $this->addComponent(new EditorComponent('Content', 'content', false));
    }

} 