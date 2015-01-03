<?php

class ModuleProjects extends Module {

    public function __construct() {
        parent::__construct('Projects');
        $this->setDescription('Display projects neatly sorted by category and status');
        $this->addLayout('multi');
        $this->addComponent(new TextComponent('Name', 'name'));
        $this->addComponent(new TextComponent('Description', 'description', false));
        $this->addComponent(new DropdownComponent('Category', 'category', array(
                'games' => 'Games',
                'development' => 'Development',
                'frontend' => 'Front-end'
            )));
        $this->addComponent(new RadioComponent('Status', 'status', array(
                'construction' => 'Under construction',
                'finished' => 'Finished',
            )));
    }

}