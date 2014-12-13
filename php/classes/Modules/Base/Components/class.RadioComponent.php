<?php

class RadioComponent extends ModuleComponent {

    private $label;
    private $id;
    private $options;

    public function __construct($label, $id = false, $options, $showInMulti = true) {
        parent::__construct($showInMulti);
        $this->label = $label;
        if($id) {
            $this->id = $id;
        }
        else {
            $this->id = $label;
        }
        $this->options = $options;
    }

    public function getId() {
        return $this->id;
    }

    public function getFormCompontent($value) {
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