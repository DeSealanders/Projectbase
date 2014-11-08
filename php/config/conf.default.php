<?php
/**
 * Class DefaultConfig
 * This file should be loaded into every page by default
 * It is responsible for loading in global functions and setting up auto inclusion
 */
class DefaultConfig {

    public function __construct() {
        require_once('php/functions/func.global.php');
    }

    public function setAutoInclude($value) {
        if(is_bool($value)) {
            Autoloader::getInstance()->setAutoinclude($value);
        }
    }
}



?>