<?php

class ModuleSlides extends Module {

    public function __construct() {
        parent::__construct('Slides');
        $this->setDescription('Manage slides which will form a slideshow');
        $this->addLayout('multi');
        $this->addComponent(new TextComponent('Title', 'title'));
        $this->addComponent(new EditorComponent('Content', 'content'));
        $this->addComponent(new TextComponent('X-coordinate', 'xpos', false));
        $this->addComponent(new TextComponent('Y-coordinate', 'ypos', false));
        $this->addComponent(new TextComponent('Z-coordinate', 'zpos', false));
        $this->addComponent(new TextComponent('Size', 'size', false, '1'));
        $this->addComponent(new TextComponent('X-rotation', 'xrot', false));
        $this->addComponent(new TextComponent('Y-rotation', 'yrot', false));
        $this->addComponent(new TextComponent('Z-rotation', 'zrot', false));
        // Multi component for rotation (x, y and z) + numberbox
        // Numberboxes for coördinates and size
    }

} 