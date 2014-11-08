<?php
/**
 * Class IncludesConfig
 * This class is responsible for maintaining a list of css and js includes
 */
class IncludesConfig {

    private $cssIncludes;
    private $jsIncludes;

    /**
     * The constructor contains a list of all includes which should be printed by the IncludeLoader
     */
    public function __construct() {

        // Start of with two empty arrays
        $this->cssIncludes = $this->jsIncludes = array();

        // Add all Javascript includes here
        $this->addJsInclude('//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js');
        $this->addJsInclude('js/documentready.js');

        // Add all Css includes here
        $this->addCssInclude('css/variables.php.css');
        $this->addCssInclude('css/default.css');

    }

    /**
     * Add a specified js file to the includes list
     * @param $file the js file to be included
     */
    private function addJsInclude($file) {
        $this->jsIncludes[] = $file;
    }

    /**
     * Add a specified css file to the includes list
     * @param $file the css file to be included
     */
    private function addCssInclude($file) {
        $this->cssIncludes[] = $file;
    }

    /**
     * Getter for all css includes
     * @return array list of css includes
     */
    public function getCssIncludes() {
        return $this->cssIncludes;
    }

    /**
     * Getter for all js includes
     * @return array list of js includes
     */
    public function getJsIncludes() {
        return $this->jsIncludes;
    }
}


?>