<?php

/**
 * Class Dropdown
 * This class represents a dropdown menu in a generated form
 */
class Dropdown extends FormComponent{

    // An array of options with the key as label and the value as option
    private $options;

    public function __construct($label, $id, $options = array(), $selected = false, $required = false) {
        parent::__construct($id, $label, $required);
        $this->options = $options;
        $this->selected = $selected;
    }

    public function printHtml() {
        echo '<div class="component">';
        echo '<label for="'. $this->id . '">' . $this->label . $this->getRequiredLabelHtml() . '</label>';
        echo '<div class="inputwrapper">';
        echo '<select autocomplete="off" ' . $this->getRequiredInputHtml() . ' name="' . $this->id . '" id="' . $this->id . '">';

        // If the dropdown is required add a first option without a value
        if($this->required) {
            $this->options = array('Select an option' => '') + $this->options;
        }
        // Print all values as an option
        foreach($this->options as $option => $label) {
            if($this->selected && $this->selected == $option) {
                $selectedHtml = 'selected="selected"';
            }
            else {
                $selectedHtml = '';
            }
            echo '<option value="' . $option . '" ' . $selectedHtml . '>' . $label . '</option>';
        }
        echo '</select>';
        echo '</div>';
        echo '</div>';
    }
} 