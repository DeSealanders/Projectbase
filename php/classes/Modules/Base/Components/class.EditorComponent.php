<?php

class EditorComponent extends ModuleComponent {

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

    public function getFormCompontent($value) {
        return new Texteditor($this->label, $this->id, '', $value);
    }
} 