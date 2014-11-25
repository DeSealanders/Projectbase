<?php
/**
 * Class AnalyticsConfig
 * This class is repsonsible for setting up the correct google analytics tracking id
 */
class AnalyticsConfig {

    private $analyticsId;
    private $enabled;

    private function __construct() {
        /*
         * --- Configuration options here ---
         */

        $this->analyticsId = '';
        $this->enabled = false;

        /*
         * --- End of configuration options ---
         */
    }

    /**
     * Function for creating only 1 instance and return that each time its called (singleton)
     * @return AnalyticsConfig
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new AnalyticsConfig();
        }
        return $instance;
    }

    /**
     * Returns the tracking id if one is entered and tracking is enabled
     * @return bool
     */
    public function getAnalyticsId() {
        if(!empty($this->analyticsId)) {
            return $this->analyticsId;
        }
        else {
            return false;
        }
    }

    public function isEnabled() {
        return $this->enabled;
    }
}



?>