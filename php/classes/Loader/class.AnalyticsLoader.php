<?php
/**
 * Class AnalyticsLoader
 * This class is responsible for printing the google analytics tracking code
 */
class AnalyticsLoader
{

    private $analyticsConfig;

    private function __construct()
    {
        $this->analyticsConfig = new AnalyticsConfig();
    }

    /**
     * Function for creating only 1 instance and return that each time its called (singleton)
     * @return AnalyticsLoader
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new AnalyticsLoader();
        }
        return $instance;
    }

    /**
     * This function prints the analytics tracking code using the analytics id set in conf.analytics.php
     */
    public function printTrackingCode()
    {
        // Only print if enabled
        if($this->analyticsConfig->isEnabled()) {

            // Only print on live
            if (isLive()) {

                // Only print if an id has been entered
                if ($this->analyticsConfig->getAnalyticsId()) {

                    // Print tracking code using id from config
                    echo "
                        <script>
                          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                          ga('create', '" . $this->analyticsConfig->getAnalyticsId() . "', 'auto');
                          ga('send', 'pageview');

                        </script>
                        ";
                }
                else {

                    // Message if no id has been entered
                    Logger::getInstance()->writeMessage('Not printing tracking code (no code has been entered)');
                }
            }
            else {

                // Message if not using when live
                Logger::getInstance()->writeMessage('Not printing tracking code (not live)');
            }
        }
    }

} 