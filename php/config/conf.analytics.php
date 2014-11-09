<?php
/**
 * Class AnalyticsConfig
 * This class is repsonsible for setting up the correct google analytics tracking id
 */
class AnalyticsConfig {

    private $analyticsId;
    private $enabled;

    public function init() {
        /*
         * --- Configuration options here ---
         */

        $this->analyticsId = '';
        $this->enabled = true;

        /*
         * --- End of configuration options ---
         */
    }

    /**
     * Returns the tracking id if one is entered and tracking is enabled
     * @return bool
     */
    public function getAnalyticsId() {
        if(!empty($this->analyticsId) && $this->enabled) {
            return $this->analyticsId;
        }
        else {
            return false;
        }
    }
}



?>