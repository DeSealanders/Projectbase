<?php

class EditorComponent extends ModuleComponent {

    public function __construct($label, $id = false, $showInMulti = true) {
        parent::__construct($label, $id, $showInMulti);
    }

    public function getFormComponent($value) {
        return new Texteditor($this->label, $this->id, '', $value);
    }

    public function getDatabaseType() {
        return 'MEDIUMTEXT';
    }

    public function getPreview($value) {
        return html_entity_decode($value);
    }
}