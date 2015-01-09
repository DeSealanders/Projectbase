<?php

class ModuleSlides extends Module {

    public function __construct() {
        parent::__construct('Slides');
        $this->setDescription('Manage slides which will form a slideshow');
        $this->addLayout('multi');
        $this->addComponent(new TextComponent('Title', 'title'));
        $this->addComponent(new EditorComponent('Content', 'content', false));
        $this->addComponent(new TextComponent('X-coordinate', 'xpos'));
        $this->addComponent(new TextComponent('Y-coordinate', 'ypos'));
        $this->addComponent(new TextComponent('Z-coordinate', 'zpos'));
        $this->addComponent(new TextComponent('Size', 'size', true, '1'));
        // Multi component for rotation (x, y and z) + numberbox
        // Numberboxes for coördinates and size
    }

} 