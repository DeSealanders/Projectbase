<?php

/**
 * Class Radiobutton
 * This class represents a list of radiobuttons menu in a generated form
 */
class Radiobutton extends FormComponent{

    // An array of options with the key as label and the value as option
    private $options;
    private $selected;

    public function __construct($label, $id, $options = array(), $selected = false, $required = false) {
        parent::__construct($id, $label, $required);
        $this->options = $options;
        $this->selected = $selected;
    }

    public function printHtml() {
        echo '<div class="component">';
        echo '<label for="'. $this->id . '">' . $this->label . $this->getRequiredLabelHtml() . '</label>';
        echo '<div class="checkboxgroup">';

        // Print all values as an option
        foreach($this->options as $option => $label) {

            if($this->selected && $this->selected == $option) {
                $selectedHtml = 'checked="checked"';
            }
            else {
                $selectedHtml = '';
            }
            echo '<div class="checkbox">';
            echo '<input  ' . $this->getRequiredInputHtml() . ' ' . $selectedHtml . ' type="radio" name="' . $this->id . '" value="' . $option . '">';
            echo '<label for id="' . $option . '">' . $label . '</label>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    }
} 