<?php

class ModuleComponent {

    protected $showInMulti;

    public function __construct($showInMulti) {
        $this->showInMulti = $showInMulti;
    }

    public function getDatabaseType() {
        return 'VARCHAR(255)';
    }

    public function getValue($value) {
        return $value;
    }

    public function showInMulti() {
        return $this->showInMulti;
    }

} 