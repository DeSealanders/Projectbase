<?php


class Dropdown extends FormComponent{

    private $options;

    public function __construct($label, $id, $options = array()) {
        parent::__construct($id, $label);
        $this->options = $options;
    }

    public function printHtml() {
        echo '<div class="component">';
        echo '<label for="'. $this->id . '">' . $this->label . '</label>';
        echo '<div class="inputwrapper">';
        echo '<select name="' . $this->id . '" id="' . $this->id . '">';
        foreach($this->options as $label => $option) {
            echo '<option value="' . $option . '">' . $label . '</option>';
        }
        echo '</select>';
        echo '</div>';
        echo '</div>';
    }
} 