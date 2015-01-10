<?php

class ModuleSlides extends Module {

    public function __construct() {
        parent::__construct('Slides');
        $this->setDescription('Manage slides which will form a slideshow');
        $this->addLayout('multi');
        $this->addComponent(new TextComponent('Title', 'title'));
        $this->addComponent(new EditorComponent('Content', 'content'));
        $this->addComponent(new NumberSliderComponent('Size', 'size', 1, 10, false));
        $this->addComponent(new TextComponent('X-coordinate', 'xpos', false));
        $this->addComponent(new TextComponent('Y-coordinate', 'ypos', false));
        $this->addComponent(new TextComponent('Z-coordinate', 'zpos', false));
        $this->addComponent(new NumberSliderComponent('X-rotation', 'xrot', 0, 360, 45, false));
        $this->addComponent(new NumberSliderComponent('Y-rotation', 'yrot', 0, 360, 45, false));
        $this->addComponent(new NumberSliderComponent('Z-rotation', 'zrot', 0, 360, 45, false));
    }

} 