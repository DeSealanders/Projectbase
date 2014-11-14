<?php


class Button extends FormComponent{

    private $label;
    private $id;
    private $type;

    public function __construct($label = 'Submit', $id, $type="submit") {
        $this->label = $label;
        $this->id = $id;
        $this->type = $type;
    }

    public function printHtml() {
        echo '<div class="component">';
        echo '<button type="' . $this->type . '" id="' . $this->id . '">' . $this->label . '</button>';
        echo '</div>';
    }
} 