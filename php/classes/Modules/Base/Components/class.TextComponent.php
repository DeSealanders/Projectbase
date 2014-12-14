<?php

class TextComponent extends ModuleComponent {

    private $label;
    private $id;

    public function __construct($label, $id = false, $showInMulti = true) {
        parent::__construct($showInMulti);
        $this->label = $label;
        if($id) {
            $this->id = $id;
        }
        else {
            $this->id = $label;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getFormComponent($value) {
        return new Textfield($this->label, $this->id, '', $value);
    }
} 