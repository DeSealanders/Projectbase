<?php

/**
 * Class Numberbox
 * This class represents an input numberbox in a generated form
 */
class Numberbox extends FormComponent{

    private $value;
    private $min;
    private $max;
    private $step;

    public function __construct($label, $id, $min = '', $max = '', $step = '', $value = '', $required = false) {
        parent::__construct($id, $label, $required);
        $this->value = $value;
        $this->min = $min;
        $this->max = $max;
        $this->step = $step;
    }

    public function printHtml() {
        // When no value is given start at minimum value
        if(is_numeric($this->value)) {
            $value = $this->value;
        }
        else if(is_numeric($this->min)){
            $value = $this->min;
        }
        else {
            $value = '';
        }

        echo '<div class="component">';
        echo '<label for="'. $this->id . '">' . $this->label . $this->getRequiredLabelHtml() . '</label>';
        echo '<div class="inputwrapper">';
        echo '<input ' . $this->getRequiredInputHtml() . ' name="' . $this->id . '" id="' . $this->id . '" type="number" min="' . $this->min . '" max="' . $this->max . '" step="' . $this->step . '" value="' . $value . '"></input>';
        echo '</div>';
        echo '</div>';
    }
} 