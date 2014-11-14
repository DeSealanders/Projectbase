<?php


class CustomHtml extends FormComponent{

    private $html;

    public function __construct($id, $html = '') {
        parent::__construct($id);
        $this->html = $html;
    }

    public function printHtml() {
        echo '<div id="' . $this->id . '" class="component">';
        echo $this->html;
        echo '</div>';
    }
} 