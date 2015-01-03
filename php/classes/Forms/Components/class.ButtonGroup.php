<?php

/**
 * Class CustomHtml
 * This class represents bit of custom html in a generated form
 * It can be used for headings, sidenotes and more
 */
class ButtonGroup extends FormComponent{

    private $components;

    public function __construct($id, $components) {
        parent::__construct($id);
        $this->components = $components;
    }

    public function printHtml() {
        echo '<div id="' . $this->id . '" class="component buttongroup">';
        foreach($this->components as $component) {
            echo $component->printHtml();
        }
        echo '</div>';
    }
} 