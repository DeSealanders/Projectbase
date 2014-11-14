<?php

class FormComponent {

    protected $id;
    protected $label;

    public function __construct($id, $label = '') {
        $this->id = $id;
        $this->label = $label;

    }

    public function printHtml() {
        echo '<p>component not configured yet</p>';
    }

    public function getId() {
        return $this->id;
    }

} 