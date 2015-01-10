<?php

/**
 * Class Numberslider
 * This class represents an input numberslider in a generated form
 */
class Numberslider extends FormComponent{

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
        if($this->value) {
            $value = $this->value;
        }
        else {
            $value = $this->min;
        }

        echo '<div class="component">';
        echo '<label for="'. $this->id . '">' . $this->label . $this->getRequiredLabelHtml() . '</label>';
        echo '<div class="inputwrapper">';
        echo '<input  ' . $this->getRequiredInputHtml() . ' name="' . $this->id . '" id="' . $this->id . '" type="range" min="' . $this->min . '" max="' . $this->max . '" step="' . $this->step . '" value="' . $value . '"></input>';
        echo '<div id="plsget" class="slidervalues">';
        echo '<span class="mindisplay">' . $this->min . '</span>';
        echo '<span class="rangedisplay" id="' . $this->id . '">test</span>';
        echo '<span class="maxdisplay">' . $this->max . '</span>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} 