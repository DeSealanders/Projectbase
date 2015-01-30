<?php

class ModuleSlideshows extends Module {

    public function __construct() {
        parent::__construct('Slideshows');
        $this->setDescription('Manage your slideshows');
        $this->addLayout('multi');
        $this->addComponent(new TextComponent('Title', 'title'));
        $this->addComponent(new OneToManyComponent('Slides', 'slides', 'slides', 'title'));
    }

} 