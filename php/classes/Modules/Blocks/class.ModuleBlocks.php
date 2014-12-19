<?php

class ModuleBlocks extends Module {

    public function __construct() {
        parent::__construct('Blocks');
        $this->setDescription('Manage the step-by-step block display on the website');
        $this->addLayout('multi');
        $this->addComponent(new TextComponent('Title', 'name'));
        $this->addComponent(new TextComponent('Description', 'description'));
        $this->addComponent(new DropdownComponent('Icon', 'category', array(
                'twitter' => 'Twitter',
                'facebook' => 'Facebook',
                'mail' => 'E-mail'
            )));
    }

} 