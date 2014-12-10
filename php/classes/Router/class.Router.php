<?php

/**
 * Class Router
 * This class is repsonsible for serving up the correct pages
 *
 * Example:
 *      www.website.com/henkdetank/
 * will be redirected to
 *      /php/pages/henkdetank.php
 */
class Router extends Singleton {

    protected function __construct() {

    }

    /**
     * This function redirects the request to the correct page
     * @param $request the page which was requested
     * @param $script the page on where this script was called from (index.php usually)
     */
    public function route($request, $script) {

        // Create a router object
        $route = new Route($request, $script);

        // Load the correct route by giving it the route
        $this->loadRoute($route);
    }

    /**
     * Load a found route based on the configurations
     * @param $route the route to be loaded (false if none could be found)
     */
    private function loadRoute($route) {

        // Load a CSS or JS include
        if($route->getType() == 'include') {
            $this->loadIncludeRoute($route->getMatchedRoute());
        }

        // Load an image
        else if($route->getType() == 'image') {

            // Let the image loader handle the rest of this request
            $imageDetails = $route->getImageDetails();

            // See if dimensions are provied
            if($imageDetails) {
                ImageLoader::getInstance()->loadImage($route->getMatchedRoute(), $imageDetails['width'], $imageDetails['height']);
            }

            // Otherwise load image directly
            else {
                $this->loadPageRoute($route->getMatchedRoute());
            }
        }

        else if($route->getType() == 'module') {
            $wrapperPage = 'php/pages/default/module_wrapper.php';

            // Set the moduledetails so it can be used in the wrapper page
            $moduleDetails = $route->getModuleDetails();
            $_SERVER['ROUTE'] = $moduleDetails;
            require($wrapperPage);
        }

        // Load a configured or regular page
        else if($route->getType() == 'configured' || $route->getType() == 'page') {
            $this->loadPageRoute($route->getMatchedRoute());
        }

        // If no route could be found, serve up the 404 page
        else if($route->getType() == 'none') {
            require 'php/pages/default/404.php';
        }
    }

    /**
     * Load a CSS or JS route
     * @param $matchedRoute the route to be loaded
     */
    private function loadIncludeRoute($matchedRoute) {
        $extension = pathinfo($matchedRoute, PATHINFO_EXTENSION);

        // Set proper content types for css
        if($extension == 'css') {
            header("Content-type: text/css");
        }

        // Set proper content types for js
        else if($extension == 'js') {
            header('Content-Type: application/javascript');
        }

        // Load the css or js file
        require($matchedRoute);

    }

    /**
     * Load a page and check if a wrapper should be used
     * @param $matchedRoute the route which will be loaded
     */
    private function loadPageRoute($matchedRoute) {
        $wrap = true;

        // Check if an image is configured
        $routeExtension = strtolower(pathinfo($matchedRoute, PATHINFO_EXTENSION));
        foreach(array('png','jpg','jpeg','gif') as $extension) {
            if($routeExtension == $extension) {

                // Use the proper header for images
                header('Content-Type: image/' . $extension);
                $wrap = false;
            }
        }

        // Load the wrapper page if it is set
        if($wrap) {
            if($wrapperPage = RouterConfig::getInstance()->getWrapperPage()) {

                // Set the route so it can be used in the wrapper page
                $_SERVER['ROUTE'] = $matchedRoute;
                require($wrapperPage);
                return;
            }
        }

        // Require the matched route
        require($matchedRoute);
    }

} 