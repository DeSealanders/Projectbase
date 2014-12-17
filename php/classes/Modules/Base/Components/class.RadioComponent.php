<?php

class RadioComponent extends ModuleComponent {

    private $options;

    public function __construct($label, $id = false, $options, $showInMulti = true) {
        parent::__construct($label, $id, $showInMulti);
        $this->options = $options;
    }

    public function getFormComponent($value) {
        return new Radiobutton($this->label, $this->id, $this->options, $value);
    }

    public function getValue($value) {
        if(isset($this->options[$value])) {
            return $this->options[$value];
        }
        else {
            return $value;
        }
    }
} 