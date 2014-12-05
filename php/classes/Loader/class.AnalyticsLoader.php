<?php
/**
 * Class AnalyticsLoader
 * This class is responsible for printing the google analytics tracking code
 */
class AnalyticsLoader extends Singleton
{

    protected function __construct()
    {

    }

    /**
     * This function prints the analytics tracking code using the analytics id set in conf.analytics.php
     */
    public function printTrackingCode()
    {
        // Only print if enabled
        if(AnalyticsConfig::getInstance()->isEnabled()) {

            // Only print on live
            if (isLive()) {

                // Only print if an id has been entered
                if ($analyticsId = AnalyticsConfig::getInstance()->getAnalyticsId()) {

                    // Print tracking code using id from config
                    echo "
                        <script>
                          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                          ga('create', '" . $analyticsId . "', 'auto');
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