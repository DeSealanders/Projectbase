<?php

class ModuleContact extends Module {

    public function __construct() {
        parent::__construct('Contact');
        $this->setDescription('Manage the contact settings displayed in the contact block');
        $this->addLayout('single');
        $this->addComponent(new TextComponent('E-mail', 'email'));
        $this->addComponent(new TextComponent('Facebook', 'facebook'));
        $this->addComponent(new TextComponent('Twitter', 'twitter'));
        $this->allowNew(false);
        $this->allowDelete(false);
    }
} 