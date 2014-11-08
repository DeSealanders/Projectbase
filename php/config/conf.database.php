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
            'database' => 'lolstatus',
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