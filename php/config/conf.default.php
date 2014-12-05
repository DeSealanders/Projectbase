<?php

// Require files used before autoloader can assist
require_once('php/classes/Misc/class.Singleton.php');
require_once('php/classes/Loader/class.Autoloader.php');
require_once('php/functions/func.global.php');

/**
 * Class DefaultConfig
 * This file should be loaded into every page by default
 * It is responsible for loading in global functions and setting up auto inclusion
 */
class DefaultConfig extends Singleton {

    private $initialized;
    private $pageNotFoundMessage;
    private $logfile;

    public function init() {
        if(!$this->initialized) {

            // Only initialize once
            $this->initialized = true;


            /*
             * --- Configuration options here ---
             */

            // Enable the auto including of class files
            $this->setAutoInclude(true);

            // The messsage for the 404 page
            $this->pageNotFoundMessage = 'Unable to find the specified page';

            // Errors will be logged to the database by default
            // Logging to a text file is a backup
            // This is the location of said text file
            $this->logfile = 'txt/errorlog.txt';

            // The website title
            $this->title = 'Projectbase';

            // The favicon which will be shown for the website
            $this->favicon = 'favicon.ico';

            // Set the default timezone
            date_default_timezone_set('Europe/Amsterdam');

            /*
             * --- End of configuration options ---
             */

        }
    }

    protected function __construct() {
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