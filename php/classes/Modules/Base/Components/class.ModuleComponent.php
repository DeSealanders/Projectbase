<?php

class ModuleComponent {

    protected $label;
    protected $id;
    protected $showInMulti;

    public function __construct($label, $id, $showInMulti) {
        $this->showInMulti = $showInMulti;
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

} 