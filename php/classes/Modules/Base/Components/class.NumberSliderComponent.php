<?php

class NumberSliderComponent extends ModuleComponent {

    private $min;
    private $max;
    private $step;

    public function __construct($label, $id = false, $min = '', $max = '', $step = '', $showInMulti = true) {
        parent::__construct($label, $id, $showInMulti);
        $this->min = $min;
        $this->max = $max;
        $this->step = $step;
    }

    public function getFormComponent($value) {
        return new Numberslider($this->label, $this->id, $this->min, $this->max, $this->step, $value);
    }
} 