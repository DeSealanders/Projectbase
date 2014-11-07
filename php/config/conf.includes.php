<?php
class IncludesConfig {

    private $cssIncludes;
    private $jsIncludes;

    public function __construct() {
        $this->cssIncludes = $this->jsIncludes = array();

        // Add all Javascript includes here
        $this->addJsInclude('//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js');
        $this->addJsInclude('js/documentready.js');

        // Add all Css includes here
        $this->addCssInclude('css/default.css');

    }

    private function addJsInclude($file) {
        $this->jsIncludes[] = $file;
    }
    private function addCssInclude($file) {
        $this->cssIncludes[] = $file;
    }

    public function getCssIncludes() {
        return $this->cssIncludes;
    }

    public function getJsIncludes() {
        return $this->jsIncludes;
    }


}


?>