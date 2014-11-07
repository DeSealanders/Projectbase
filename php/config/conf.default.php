<?php
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