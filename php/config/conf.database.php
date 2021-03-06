<?php
/**
 * Class DatabaseConfig
 * This class is the config file for the database
 */
class DatabaseConfig extends Singleton {

    private $localDetails;
    private $liveDetails;

    protected function __construct() {

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
            'password' => '21c5NHG07',
            'username' => 'tonpeter_pjb',
            'database' => 'tonpeter_pjb',
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