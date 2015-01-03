<?php

/**
 * Class Colorpicker
 * This class represents a clickable button in a generated form
 */
class Colorpicker extends FormComponent{

    private $value;

    public function __construct($label, $id, $value, $required = false) {
        parent::__construct($id, $label, $required);
        $this->value = $value;
    }

    public function printHtml() {
        echo '<div class="component">';
        echo '<label for="'. $this->id . '">' . $this->label . $this->getRequiredLabelHtml() . '</label>';
        echo '<div class="inputwrapper">';
        echo '<div id="' . $this->id . '" data-color="' . $this->value . '" class="color-box"></div>';
        echo '<input id="' . $this->id . '" name="' . $this->id . '" value="' . $this->value . '" type="hidden"></input>';
        echo '</div>';
        echo '</div>';
    }
} 