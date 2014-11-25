<?php
/**
 * Class RouterConfig
 * This class is repsonsible for setting up alternative routes
 */
class RouterConfig {

    private $wrapperPage;
    private $routes;

    private function __construct() {
        /*
         * --- Configuration options here ---
         */

        // The page to be loaded by default
        // Set to false if none should be loaded
        $this->wrapperPage = 'php/pages/wrapper.php';

        /* Alternative routes
         * The key is the incoming page (visible to the client)
         * The value is actual file loaded (not visible to the client)
         * Example:
         *      'henk/de/tank' => 'php/pages/sjonbontebal.php'
         */
        $this->routes = array(

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