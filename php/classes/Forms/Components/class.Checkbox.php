<?php

/**
 * Class Checkbox
 * This class represents a list of checkboxes in a generated form
 */
class Checkbox extends FormComponent{

    // An array of options with the key as label and the value as option
    private $options;

    public function __construct($label, $id, $options = array(), $required = false) {
        parent::__construct($id, $label, $required);
        $this->options = $options;
    }

    public function printHtml() {
        echo '<div class="component">';
        echo '<label for="'. $this->id . '">' . $this->label . '</label>';
        echo '<div class="checkboxgroup">';
        foreach($this->options as $label => $option) {
            echo '<div class="checkbox">';
            echo '<input  ' . $this->getRequiredHtml() . ' type="checkbox" name="' . $option . '" value="checked">';
            echo '<label for id="' . $option . '">' . $label . '</label>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    }
} 