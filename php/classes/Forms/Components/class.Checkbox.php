<?php


class Checkbox extends FormComponent{

    private $options;

    public function __construct($label, $id, $options = array()) {
        parent::__construct($id, $label);
        $this->options = $options;
    }

    public function printHtml() {
        echo '<div class="component">';
        echo '<label for="'. $this->id . '">' . $this->label . '</label>';
        echo '<div class="checkboxgroup">';
        foreach($this->options as $label => $option) {
            echo '<div class="checkbox">';
            echo '<input type="checkbox" name="' . $option . '" value="checked">';
            echo '<label for id="' . $option . '">' . $label . '</label>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    }
} 