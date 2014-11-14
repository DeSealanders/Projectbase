<?php

/**
 * Class Emailfield
 * This class represents an e-mail input field in a generated form
 */
class Emailfield extends FormComponent{

    private $placeholder;
    private $value;

    public function __construct($label, $id, $placeholder = '', $value = '', $required = false) {
        parent::__construct($id, $label, $required);
        $this->placeholder = $placeholder;
        $this->value = $value;
    }

    public function printHtml() {
        echo '<div class="component">';
        echo '<label for="'. $this->id . '">' . $this->label . '</label>';
        echo '<div class="inputwrapper">';
        echo '<input  ' . $this->getRequiredHtml() . ' name="' . $this->id . '" id="' . $this->id . '" type="email" placeholder="' . $this->placeholder . '" value="' . $this->value . '"></input>';
        echo '</div>';
        echo '</div>';
    }
} 