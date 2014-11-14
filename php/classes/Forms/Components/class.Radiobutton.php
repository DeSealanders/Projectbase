<?php

/**
 * Class Radiobutton
 * This class represents a list of radiobuttons menu in a generated form
 */
class Radiobutton extends FormComponent{

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

        // Print all values as an option
        foreach($this->options as $label => $option) {
            echo '<div class="checkbox">';
            echo '<input  ' . $this->getRequiredHtml() . ' type="radio" name="' . $this->id . '" value="' . $option . '">';
            echo '<label for id="' . $option . '">' . $label . '</label>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    }
} 