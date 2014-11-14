<?php

/**
 * Class Dropdown
 * This class represents a dropdown menu in a generated form
 */
class Dropdown extends FormComponent{

    // An array of options with the key as label and the value as option
    private $options;

    public function __construct($label, $id, $options = array(), $required = false) {
        parent::__construct($id, $label, $required);
        $this->options = $options;
    }

    public function printHtml() {
        echo '<div class="component">';
        echo '<label for="'. $this->id . '">' . $this->label . '</label>';
        echo '<div class="inputwrapper">';
        echo '<select  ' . $this->getRequiredHtml() . ' name="' . $this->id . '" id="' . $this->id . '">';

        // If the dropdown is required add a first option without a value
        if($this->required) {
            $this->options = array('Selecteer een optie' => '') + $this->options;
        }

        // Print all values as an option
        foreach($this->options as $label => $option) {
            echo '<option value="' . $option . '">' . $label . '</option>';
        }
        echo '</select>';
        echo '</div>';
        echo '</div>';
    }
} 