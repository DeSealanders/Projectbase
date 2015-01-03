<?php

class ModuleColors extends Module {

    public function __construct() {
        parent::__construct('Colors');
        $this->setDescription('Manage colors for website background and text');
        $this->addLayout('multi');
        $this->addComponent(new ColorpickerComponent('Background color 1', 'backgroundcolor1'));
        $this->addComponent(new ColorpickerComponent('Background color 2', 'backgroundcolor2'));
        $this->addComponent(new ColorpickerComponent('Text color 1', 'textcolor1'));
        $this->addComponent(new ColorpickerComponent('Text color 2', 'textcolor2'));
        $this->allowNew(false);
        $this->allowDelete(false);
    }

} 