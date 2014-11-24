<?php
/**
 * Class RouterConfig
 * This class is repsonsible for setting up alternative routes
 */
class RouterConfig {

    private $defaultPage;
    private $routes;

    public function __construct() {
        /*
         * --- Configuration options here ---
         */

        // The page to be loaded by default
        // Set to false if none should be loaded
        $this->defaultPage = 'php/pages/default.php';

        /* Alternative routes
         * The key is the incoming page (visible to the client)
         * The value is actual file loaded (not visible to the client)
         * Example:
         *      'henk/de/tank' => 'php/pages/sjonbontebal.php'
         */
        $this->routes = array(
            'henk/de/tank' => 'php/pages/demoform.php'
        );

        /*
         * --- End of configuration options ---
         */
    }

    public function getDefaultPage() {
        return $this->defaultPage;
    }

    public function getRoutes() {
        return $this->routes;
    }
}



?>