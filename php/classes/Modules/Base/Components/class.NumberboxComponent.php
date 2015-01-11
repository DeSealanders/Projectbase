<?php

class NumberboxComponent extends ModuleComponent {

    private $min;
    private $max;
    private $step;

    public function __construct($label, $id = false, $min = '', $max = '', $step = '', $showInMulti = true, $defaultValue = false, $group = false) {
        parent::__construct($label, $id, $showInMulti, $defaultValue);
        $this->min = $min;
        $this->max = $max;
        $this->step = $step;
        $this->group = $group;
    }

    public function getFormComponent($value) {
        $value = $this->getValue($value);
        return new Numberbox($this->label, $this->id, $this->min, $this->max, $this->step, $value);
    }

    public function getGroup() {
        return $this->group;
    }
} 