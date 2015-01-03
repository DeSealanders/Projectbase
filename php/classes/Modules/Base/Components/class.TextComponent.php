<?php

class TextComponent extends ModuleComponent {

    public function __construct($label, $id = false, $showInMulti = true) {
        parent::__construct($label, $id, $showInMulti);
    }

    public function getFormComponent($value) {
        return new Textfield($this->label, $this->id, '', $value);
    }
} 