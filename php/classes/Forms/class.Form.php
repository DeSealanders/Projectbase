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

        // Print html for each individual form component
        foreach($this->components as $component) {
            $component->printHtml();
        }
        echo '</form>';

    }

    public function addComponent($component) {

        // Check if the given id is not already used for another component
        if(!array_key_exists($component->getId(), $this->components)) {
            $this->components[$component->getId()] = $component;
        }
        else {
            Logger::getInstance()->writeMessage('Duplicate id found in form: ' . $this->id);
        }
    }

} 