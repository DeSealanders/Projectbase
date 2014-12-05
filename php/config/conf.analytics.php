<?php
/**
 * Class AnalyticsConfig
 * This class is repsonsible for setting up the correct google analytics tracking id
 */
class AnalyticsConfig extends Singleton {

    private $analyticsId;
    private $enabled;

    protected function __construct() {
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