<?php

class Form {

    private $name;
    private $id;
    private $components;

    public function __construct($name, $id) {
        $this->name = $name;
        $this->id = $id;
        $this->components = array();
    }

    public function printHtml() {
        echo '<form method="POST" class="customForm" id="' . $this->id . '">';
        echo '<h2>' . $this->name . '</h2>';
        foreach($this->components as $component) {
            $component->printHtml();
        }
        echo '</form>';

    }

    public function addComponent($component) {
        $this->components[] = $component;
    }

} 