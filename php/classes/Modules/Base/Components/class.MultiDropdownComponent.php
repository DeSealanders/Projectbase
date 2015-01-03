<?php

class MultiDropdownComponent extends ModuleComponent {

    private $options;

    public function __construct($label, $id = false, $options, $showInMulti = true) {
        parent::__construct($label, $id, $showInMulti);
        $this->options = $options;
    }

    public function getFormComponent($value) {
        return new MultiDropdown($this->label, $this->id, $this->options, $value);
    }

    public function getPreview($value) {
        $values = array();

        // Translate database array to readable option values
        foreach(explode('|', $value) as $entry) {
            $entries = explode(',', $entry);
            if(count($entries) == 2) {
                $keys = array_keys($this->options[$entries[0]]);
                $category = reset($keys);
                $values[] = $category . ' - ' . reset($this->options[$entries[0]])[$entries[1]];
            }
        }
        return implode('<br>', $values);
    }

    public function saveData($data) {

        // Translate associative array into a single string for database storage
        $enties = array();
        foreach($data as $entry) {
            $enties[] = implode(',', $entry);
        }
        return implode('|', $enties);
    }
} 