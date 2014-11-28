<?php
/**
 * Class FormComponent
 * This class represent a single component in a generated form
 * It has certain properties built in which apply to all form elements
 */
class FormComponent {

    protected $id;
    protected $label;
    protected $required;

    public function __construct($id, $label = '', $required = false) {
        $this->id = $id;
        $this->label = $label;
        $this->required = $required;
    }

    public function printHtml() {
        echo '<p>component not configured yet</p>';
    }

    public function getId() {
        return $this->id;
    }

    protected function getRequiredInputHtml() {
        if($this->required) {
            return 'required';
        }
        else {
            return '';
        }
    }

    public function getRequiredLabelHtml() {
        if($this->required) {
            return '<span class="required">*</span>';
        }
        else {
            return '';
        }
    }

} 