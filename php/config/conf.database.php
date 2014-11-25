<?php
/**
 * Class DatabaseConfig
 * This class is the config file for the database
 */
class DatabaseConfig {

    private $localDetails;
    private $liveDetails;

    public function __construct() {

        /*
         * --- Configuration options here ---
         */

        $this->localDetails = array(
            'username' => 'root',
            'password' => 'usbw',
            'database' => 'test',
            'address' => 'localhost'
        );
        $this->liveDetails = array(
            'password' => 'abc',
            'username' => 'abc',
            'database' => 'abc',
            'address' => 'localhost'
        );

        /*
         * --- End of configuration options ---
         */

    }

    /**
     * Function for creating only 1 instance and return that each time its called (singleton)
     * @return DatabaseConfig
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new DatabaseConfig();
        }
        return $instance;
    }

    /**
     * Return database details on basis of host location
     * @return array database details
     */
    public function getDbDetails() {
        if(isLive()) {
            return $this->getLiveDetails();
        }
        else {
            return $this->getLocalDetails();
        }
    }

    /**
     * Returns a list of local database settings
     * @return array
     */
    private function getLocalDetails() {
        return $this->localDetails;
    }

    /**
     * Returns a list of live database settings
     * @return array
     */
    private function getLiveDetails() {
        return $this->liveDetails;
    }
}