<?php

class ModuleComponent {

    protected $label;
    protected $id;
    protected $showInMulti;
    protected $defaultValue;

    public function __construct($label, $id, $showInMulti, $defaultValue = false) {
        $this->showInMulti = $showInMulti;
        $this->defaultValue = $defaultValue;
        $this->label = $label;
        if($id) {
            $this->id = $id;
        }
        else {
            $this->id = $label;
        }
    }

    public function getDatabaseType() {
        return 'VARCHAR(255)';
    }

    public function getPreview($value) {
        return $value;
    }

    public function showInMulti() {
        return $this->showInMulti;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getId() {
        return $this->id;
    }

    public function saveData($data) {
        return htmlentities($data);
    }

    public function getValue($value) {
        if(is_null($value)) {
            if(is_numeric($this->defaultValue)) {
                return $this->defaultValue;
            }
        }
        return $value;
    }
} 