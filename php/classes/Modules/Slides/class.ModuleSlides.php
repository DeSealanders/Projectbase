<?php

class ModuleSlides extends Module {

    public function __construct() {
        parent::__construct('Slides');
        $this->setDescription('Manage slides which will form a slideshow');
        $this->addComponent(new TextComponent('Title', 'title'));
        $this->addComponent(new EditorComponent('Content', 'content'));
        $this->addComponent(new NumberSliderComponent('Size', 'size', 1, 10, false));
        $this->addComponent(new NumberboxComponent('X-coordinate', 'xpos', '', '', 100, false, 0));
        $this->addComponent(new NumberboxComponent('Y-coordinate', 'ypos', '', '', 100, false, 0));
        $this->addComponent(new NumberboxComponent('Z-coordinate', 'zpos', '', '', 100, false, 0));
        $this->addComponent(new NumberSliderComponent('X-rotation', 'xrot', 0, 360, 45, false));
        $this->addComponent(new NumberSliderComponent('Y-rotation', 'yrot', 0, 360, 45, false));
        $this->addComponent(new NumberSliderComponent('Z-rotation', 'zrot', 0, 360, 45, false));
        // Todo position
    }

} 