<?php

class ModuleProjects extends Module {

    public function __construct() {
        parent::__construct('Projects');
        $this->addLayout('multi');
        $this->addComponent(new TextComponent('Name', 'name'));
        $this->addComponent(new TextComponent('Description', 'description'));
        $this->addComponent(new RadioComponent('Status', 'status', array(
                'construction' => 'Under construction',
                'finished' => 'Finished',
            )));
        $this->addComponent(new CheckboxComponent('Tags', 'tags', array(
                'games' => 'Games',
                'socialmedia' => 'Social Media',
                'ownuse' => 'For own use',
                'collaborated' => 'Collaborated'
            ), false));
    }

} 