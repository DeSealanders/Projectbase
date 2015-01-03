<?php

/**
 * Class Button
 * This class represents a clickable button in a generated form
 */
class Button extends FormComponent{

    private $value;
    private $type;

    public function __construct($label = 'Submit', $id, $value = '', $type="submit") {
        parent::__construct($id, $label);
        $this->type = $type;
        if(!empty($value)) {
            $this->value = $value;
        }
        else {
            $this->value = $label;
        }
    }

    public function printHtml() {
        echo '<div class="component">';
        echo '<button value = "' . $this->value . '" name="' . $this->id . '" type="' . $this->type . '" id="' . $this->id . '">' . $this->label . '</button>';
        echo '</div>';
    }
} 