<?php
/**
 * Class DefaultConfig
 * This file should be loaded into every page by default
 * It is responsible for loading in global functions and setting up auto inclusion
 */
class DefaultConfig {

    private $initialized;
    private $pageNotFoundMessage;
    private $logfile;

    public function init() {
        if(!$this->initialized) {

            require_once('php/functions/func.global.php');

            // Only initialize once
            $this->initialized = true;


            /*
             * --- Configuration options here ---
             */

            // Enable the auto including of class files
            $this->setAutoInclude(true);

            // The messsage for the 404 page
            $this->pageNotFoundMessage = 'Unable to find the specified page';

            // Log file for errors
            $this->logfile = 'txt/errorlog.txt';

            // Set the default timezone
            date_default_timezone_set('Europe/Amsterdam');

            /*
             * --- End of configuration options ---
             */

        }
    }

    /**
     * Function for creating only 1 instance and return that each time its called (singleton)
     * @return DefaultConfig
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new DefaultConfig();
        }
        return $instance;
    }

    private function __construct() {
        $this->initialized = false;
        $this->init();
    }

    private function setAutoInclude($value) {
        if(is_bool($value)) {
            Autoloader::getInstance()->setAutoinclude($value);
        }
    }

    public function getPageNotFoundMessage() {
        return $this->pageNotFoundMessage;
    }

    public function getLogfile() {
        return $this->logfile;
    }
}



?>