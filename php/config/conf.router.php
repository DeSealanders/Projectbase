<?php
/**
 * Class RouterConfig
 * This class is repsonsible for setting up alternative routes
 */
class RouterConfig extends Singleton {

    private $wrapperPage;
    private $routes;

    protected function __construct() {
        /*
         * --- Configuration options here ---
         */

        // The page to be loaded by default
        // Set to false if none should be loaded
        $this->wrapperPage = 'php/pages/default/front_wrapper.php';

        /* Alternative routes
         * The key is the incoming page (visible to the client)
         * The value is actual file loaded (not visible to the client)
         * Example:
         *      'henk/de/tank' => 'php/pages/sjonbontebal.php'
         */
        $this->routes = array(
            /*array('origin' => 'module',
                  'destination' => 'php/pages/default/backend.php',
                  'wrap' => false)*/
        );

        /*
         * --- End of configuration options ---
         */
    }

    /**
     * Function for creating only 1 instance and return that each time its called (singleton)
     * @return RouterConfig
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new RouterConfig();
        }
        return $instance;
    }

    public function getWrapperPage() {
        return $this->wrapperPage;
    }

    public function getRoutes() {
        return $this->routes;
    }
}



?>