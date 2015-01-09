<?php

class ModuleSlides extends Module {

    public function __construct() {
        parent::__construct('Slides');
        $this->setDescription('Manage slides which will form a slideshow');
        $this->addLayout('multi');
        $this->addComponent(new TextComponent('Title', 'name'));
        $this->addComponent(new EditorComponent('Content', 'content', false));
        $this->addComponent(new TextComponent('X-coordinate', 'xpos'));
        $this->addComponent(new TextComponent('Y-coordinate', 'ypos'));
    }

} 