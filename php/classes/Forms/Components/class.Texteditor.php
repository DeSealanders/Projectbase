<?php

/**
 * Class Textbox
 * This class represents a basic textfield in a generated form
 */
class Texteditor extends FormComponent{

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
        echo '<textarea class="textEditor" cols="80" rows="20" ' . $this->getRequiredInputHtml() . ' name="' . $this->id . '" id="' . $this->id . '" type="text" placeholder="' . $this->placeholder . '">' . $this->value . '</textarea>';
        echo '</div>';
        echo '</div>';
    }
} 