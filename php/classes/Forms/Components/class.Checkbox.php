<?php

/**
 * Class Checkbox
 * This class represents a list of checkboxes in a generated form
 */
class Checkbox extends FormComponent{

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
        foreach($this->options as $option => $label) {

            if($this->selected && in_array($option, explode(',', $this->selected))) {
                $selectedHtml = 'checked="checked"';
            }
            else {
                $selectedHtml = '';
            }
            echo '<div class="checkbox">';
            echo '<input  ' . $this->getRequiredInputHtml() . ' ' . $selectedHtml . ' type="checkbox" name="' . $option . '" value="checked">';
            echo '<label for id="' . $option . '">' . $label . '</label>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    }
} 