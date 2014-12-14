<?php

class CheckboxComponent extends ModuleComponent {

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

    public function getFormComponent($value) {
        return new Checkbox($this->label, $this->id, $this->options, $value);
    }

    public function getValue($value) {
        $options = array();
        foreach(explode(',', $value) as $value) {
            if(isset($this->options[$value])) {
                $options[] = $this->options[$value];
            }
        }
        if(!empty($options)) {
            return implode(', ', $options);
        }
        else {
            return $value;
        }
    }

    public function getOptions() {
        return $this->options;
    }
} 