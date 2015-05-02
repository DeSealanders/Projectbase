<?php

class ModuleSlideshows extends Module {

    public function __construct() {
        parent::__construct('Slideshows');
        $this->setDescription('Add and remove slides to form a slideshow');
        $this->addLayout('multi');
        $this->addLayout('single');
        $this->addLayout('api');
        $this->addComponent(new TextComponent('Title', 'title'));
        $this->addComponent(new EditorComponent('Description', 'description'));
        $this->addComponent(new OneToManyComponent('Slides', 'slides', 'slides', 'title'));
        $this->addComponent(new FileuploadComponent('Image', 'image'));
    }

} 