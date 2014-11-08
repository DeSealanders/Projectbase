<?php
/**
 * Class DatabaseConfig
 * This class is the config file for the database
 */
class DatabaseConfig {

    public function __construct() {
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
        return array(
            'username' => 'root',
            'password' => 'usbw',
            'database' => 'lolstatus',
            'address' => 'localhost'
        );
    }

    /**
     * Returns a list of live database settings
     * @return array
     */
    private function getLiveDetails() {
        return array(
            'password' => 'abc',
            'username' => 'abc',
            'database' => 'abc',
            'address' => 'localhost'
        );
    }
}