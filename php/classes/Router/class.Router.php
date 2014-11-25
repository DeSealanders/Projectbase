<?php

/**
 * Class Router
 * This class is repsonsible for loading the correct pages
 * It does:
 * 1. Look for alternative routes configured in conf.router.php
 * 2. Redirect all remaining requests to their respective files in /php/pages/
 * 3. Serve up the 404 page if no page could be found
 * Example:
 *      www.website.com/henkdetank/
 * will be redirected to
 *      /php/pages/henkdetank.php
 */
class Router {

    private $routerConfig;
    private $includeConfig;

    /**
     * Load config settings
     */
    private function __construct() {
        $this->routerConfig = new RouterConfig();
        $this->includeConfig = new IncludesConfig();
    }
    /**
     * Function for creating only 1 instance and return that each time its called (singleton)
     * @return Router
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new Router();
        }
        return $instance;
    }

    /**
     * This function redirects the request to the correct page
     * @param $request the page which was requested
     * @param $script the page on where this script was called from (index.php usually)
     */
    public function route($request, $script) {

        // First pares the url
        $route = $this->parseUrl($request, $script);

        // Then check if a route could be matched (from config or default page settings)
        $matchedRoute = $this->matchRoute($route);

        // Then load the found route
        $this->loadRoute($matchedRoute);

    }

    /**
     * Convert the request and script url into a parsed url
     * @param $request the page which was requested
     * @param $script the page on where this script was called from (index.php usually)
     * @return string script url substracted from the request url
     */
    private function parseUrl($request, $script) {

        // First create arrays from both urls
        $request = explode('/', $request);
        $script = explode('/', $script);

        // Then compare them (case-insensitive)
        $parsedUrl = array_udiff($request, $script, 'strcasecmp');

        // When no directory is found, send to root
        if(empty($parsedUrl)) {
            $parsedUrl[0] = 'index';
        }

        // Return the remainder of the url
        return $parsedUrl;
    }

    /**
     * Match the parsed route to the configured routes
     * If none could be found check the default routes
     * @param $route the route to be matched to a page
     * @return bool|string the route if one could be found, false otherwise
     */
    private function matchRoute($url) {

        // Check for configured routes first
        if(!($matchedRoute = $this->isConfiguredRoute(implode('/', $url)))) {

            // Check to see if this is an JS or CSS include
            if(!($matchedRoute = $this->isIncludeRoute($url))) {

                // Use default route if no configured routes have been found
                if(!($matchedRoute = $this->isDefaultRoute(implode('/', $url)))) {

                    // No route could be found
                    $matchedRoute = false;

                }
            }

        }
        return $matchedRoute;
    }

    /**
     * Load a found route based on the configurations
     * @param $route the route to be loaded (false if none could be found)
     */
    private function loadRoute($route) {

        // Do include route in default page if configured so
        $showRaw = false;

        // Retrieve file extension
        $extension = pathinfo($route, PATHINFO_EXTENSION);

        // Set proper content types for css
        if($extension == 'css') {
            header("Content-type: text/css");
            $showRaw = true;
        }

        // Set proper content types for js
        else if($extension == 'js') {
            header('Content-Type: application/javascript');
            $showRaw = true;
        }

        // Load the default page if it is set
        if($route && !$showRaw && $defaultPage = $this->routerConfig->getDefaultPage()) {

            // Set the route so it can be used in the default page
            $_SERVER['ROUTE'] = $route;
            require($defaultPage);
        }

        // Load the found route without a default page
        else if($route) {
            require($route);
        }

        // If no route could be found, serve up the 404 page
        else {
            require 'php/pages/404.php';
        }
    }

    /**
     * Check the conf.router.php file for a matching route
     * @param $route the route to be matched
     * @return bool|string the route if one could be found, false otherwise
     */
    private function isConfiguredRoute($route) {
        $matchedRoute = false;

        // Go through the configured routes
        $confRoutes = $this->routerConfig->getRoutes();
        foreach($confRoutes as $origin => $destination) {

            // Compare each to the route entered by the user
            if($origin == $route) {
                $matchedRoute = $destination;
            }
        }

        return $matchedRoute;
    }

    /**
     * Check the conf.includes.php file for any includes
     * @param $route the route to be matched
     * @return bool|string the include if one could be found, false otherwise
     */
    private function isIncludeRoute($route) {

        // Load all configured includes
        $confIncludes = array_merge($this->includeConfig->getCssIncludes(), $this->includeConfig->getJsIncludes());

        // See if an include matches the route
        foreach($confIncludes as $include) {
            if (strpos(implode('/', $route), $include) !== false) {
                return $include;
            }
        }
        return false;
    }

    /**
     * Check if the requested route is a page in the /php/pages/ folder
     * @param $route the requested route
     * @return bool|string the route if one could be found, false otherwise
     */
    private function isDefaultRoute($route) {

        // Add .php extension if not present
        if(pathinfo($route, PATHINFO_EXTENSION) == '') {
            $route .= '.php';
        }

        // See if default route exists
        $defaultRoute = 'php/pages/' . $route;
        if(file_exists($defaultRoute)) {
            return $defaultRoute;
        }
        else {
            return false;
        }
    }

} 