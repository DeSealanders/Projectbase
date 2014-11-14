<?php


class Textbox extends FormComponent{

    private $label;
    private $id;
    private $placeholder;
    private $value;

    public function __construct($label, $id, $placeholder = '', $value = '') {
        $this->label = $label;
        $this->id = $id;
        $this->placeholder = $placeholder;
        $this->value = $value;
    }

    public function printHtml() {
        echo '<div class="component">';
        echo '<label for="'. $this->id . '">' . $this->label . '</label>';
        echo '<div class="inputwrapper">';
        echo '<textarea  name="' . $this->id . '" id="' . $this->id . '" type="text" placeholder="' . $this->placeholder . '" value="' . $this->value . '"></textarea>';
        echo '</div>';
        echo '</div>';
    }
} 