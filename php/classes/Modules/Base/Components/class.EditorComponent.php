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

        // Decode database entries
        $decoded = html_entity_decode($value);

        // Replace headings with paragraphs
        $strippedHeadings = preg_replace('/<h([1-6])>(.*)<\/h([1-6])>/', '<p>${2}</p>', $decoded);

        // Remove any other html apart from <br> and <p> tags
        return strip_tags($strippedHeadings, '<br><p>');
    }
}