<?php
/**
 * Class DefaultConfig
 * This file should be loaded into every page by default
 * It is responsible for loading in global functions and setting up auto inclusion
 */
class DefaultConfig {

    private $pageNotFoundMessage;

    public function __construct() {
        require_once('php/functions/func.global.php');

        /* --- Configuration options here --- */

        // Enable the auto including of class files
        $this->setAutoInclude(true);

        // The messsage for the 404 page
        $this->pageNotFoundMessage = 'Unable to find the specified page';

    }

    private function setAutoInclude($value) {
        if(is_bool($value)) {
            Autoloader::getInstance()->setAutoinclude($value);
        }
    }

    public function getPageNotFoundMessage() {
        return $this->pageNotFoundMessage;
    }
}



?>