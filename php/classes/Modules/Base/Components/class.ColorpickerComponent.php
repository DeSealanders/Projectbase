<?php

class ColorpickerComponent extends ModuleComponent {

    public function __construct($label, $id = false, $showInMulti = true) {
        parent::__construct($label, $id, $showInMulti);
    }

    public function getFormComponent($value) {
        return new Colorpicker($this->label, $this->id, $value);
    }

    public function getValue($value) {
        return '<div class="color-preview" style="background-color: ' . $value . ';"></div>';
    }
} 