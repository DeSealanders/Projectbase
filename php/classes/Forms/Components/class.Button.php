<?php


class Button extends FormComponent{

    private $type;

    public function __construct($label = 'Submit', $id, $type="submit") {
        parent::__construct($id, $label);
        $this->type = $type;
    }

    public function printHtml() {
        echo '<div class="component">';
        echo '<button type="' . $this->type . '" id="' . $this->id . '">' . $this->label . '</button>';
        echo '</div>';
    }
} 