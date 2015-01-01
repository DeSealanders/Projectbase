<?php

/**
 * Class PasswordField
 * This class represents an input passwordField in a generated form
 */
class PasswordField extends FormComponent{

    private $placeholder;
    private $value;

    public function __construct($label, $id, $placeholder = '', $value = '', $required = false) {
        parent::__construct($id, $label, $required);
        $this->placeholder = $placeholder;
        $this->value = $value;
    }

    public function printHtml() {
        echo '<div class="component">';
        echo '<label for="'. $this->id . '">' . $this->label . $this->getRequiredLabelHtml() . '</label>';
        echo '<div class="inputwrapper">';
        echo '<input  ' . $this->getRequiredInputHtml() . ' name="' . $this->id . '" id="' . $this->id . '" type="password" placeholder="' . $this->placeholder . '" value="' . $this->value . '"></input>';
        echo '</div>';
        echo '</div>';
    }
} 