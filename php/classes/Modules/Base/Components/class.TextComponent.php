<?php

class TextComponent {

    private $label;
    private $id;

    public function __construct($label, $id = false) {
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
        return new Textfield($this->label, $this->id, '', $value);
    }

    public function getDatabaseType() {
        return 'VARCHAR(255)';
    }
} 