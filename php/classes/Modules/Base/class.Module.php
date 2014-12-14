<?php

class Module {

    private $name;
    private $components;
    private $backend;
    private $frontend;
    private $records;
    private $cleanRecords;

    public function __construct($name) {
        $this->name = $name;
        $this->components = array();
        $this->backend = new ModuleBackend($this);
        $this->frontend = new ModuleFrontend($this);
        $this->cleanRecords = false;
    }

    /* -------------- Shared -------------- */

    public function addComponent($component) {
        $this->components[$component->getId()] = $component;
    }

    public function getModulePath() {
        return 'php/classes/Modules/' . $this->name . '/';
    }

    public function getName() {
        return $this->name;
    }

    public function getComponents() {
        return $this->components;
    }

    public function setRecords($records) {
        $this->records = $records;
    }

    public function getRecords() {
        return $this->records;
    }

    public function getRecord($itemid) {
        if($itemid) {
            foreach($this->records as $record) {
                if(isset($record['itemid'])) {
                    if($record['itemid'] == $itemid) {
                        return $record;
                    }
                }
            }
        }
    }

    public function getComponentNames() {
        $columns = array();
        foreach($this->components as $component) {
            $columns[strtolower($component->getId())] = $component->getDatabaseType();
        }
        return $columns;
    }

    public function getMultiComponents() {
        $components = array();
        foreach($this->components as $component) {
            if($component->showInMulti()) {
                $components[] = $component->getId();
            }
        }
        return $components;
    }

    public function getCleanRecords() {
        if($this->cleanRecords) {
            return $this->cleanRecords;
        }
        else {

            // Clone the original records
            $cleanRecords = $this->records;

            // Replace values with component values if possible
            foreach($this->records as $num => $record) {
                foreach($this->components as $key => $component) {
                    if(isset($record[$component->getId()])) {

                        // Get the value from the database
                        $databaseValue = $record[$component->getId()];

                        // Translate the database value into a display value
                        $cleanRecords[$num][$key] = $component->getValue($databaseValue);
                    }
                }
            }
            return $cleanRecords;
        }
    }

    /* -------------- Backend -------------- */

    public function printBackendHtml($layout, $itemid = false) {
        return $this->backend->printHtml($layout, $itemid);
    }

    /* -------------- Frontend -------------- */

    public function printFrontendHtml($layout, $itemid = false) {
        return $this->frontend->printHtml($layout, $itemid);
    }

    public function addLayout($layout) {
        $this->frontend->addLayout($layout);
    }

} 