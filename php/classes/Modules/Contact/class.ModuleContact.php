<?php

class ModuleContact extends Module {

    public function __construct() {
        parent::__construct('Contact');
        $this->addLayout('single');
        $this->addComponent(new TextComponent('First name', 'firstname'));
        $this->addComponent(new TextComponent('Last name', 'lastname'));
    }

} 