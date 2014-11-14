<?php

/**
 * Class CustomHtml
 * This class represents bit of custom html in a generated form
 * It can be used for headings, sidenotes and more
 */
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