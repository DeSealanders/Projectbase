<?php
/**
 * Class Route
 * This class is repsonsible for parsing a route url and determining its destination
 */
class Route {

    private $route;
    private $type;
    private $matchedRoute;
    private $imageDetails;
    private $moduleDetails;
    private $wrap;

    public function __construct($request, $script) {
        $this->wrap = true;
        $this->route = $this->parseUrl($request, $script);
        $this->matchedRoute = $this->getDestination($this->route);
    }

    /**
     * Getter for the type of the route
     * This can be configured, image, include, page or none
     * @return mixed a string containing the type of the route
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Getter for the route matched
     * @return bool|string a route if one could be found
     */
    public function getMatchedRoute() {
        return $this->matchedRoute;
    }

    /**
     * Getter for details for an image url (width, height and filepath)
     * @return mixed a list of details for the image specified in the route
     */
    public function getImageDetails() {
        return $this->imageDetails;
    }

    public function getModuleDetails() {
        return $this->moduleDetails;
    }

    public function getWrap() {
        return $this->wrap;
    }

    public function setWrap($wrap) {
        $this->wrap = $wrap;
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

        // Return the parsed url (with reset index numbers)
        return array_values($parsedUrl);
    }

    /**
     * Match the parsed route by checking for a configured routes, images, includes or pages
     * @param $route the route to be matched to a page
     * @return bool|string the route if one could be found, false otherwise
     */
    private function getDestination($route) {

        // Create a filepath for the route
        $routePath = implode('/', $route);

        // First check if the route is configured
        if($matchedRoute = $this->isConfiguredRoute($routePath)) {
            $this->type = 'configured';
        }

        // Secondly check if an image is specified
        else if($matchedRoute = $this->isImage($route)) {
            $this->type = 'image';
        }

        // Thirdly check if route is a CSS or JS inlcude
        else if($matchedRoute = $this->isInclude($routePath)) {
            $this->type = 'include';
        }

        // Otherwise check for a page matching this route
        else if($matchedRoute = $this->isModule($route)) {
            $this->type = 'module';
        }

        // Otherwise check for a page matching this route
        else if($matchedRoute = $this->isPage($routePath)) {
            $this->type = 'page';
        }

        // Return false if no type could be found
        else {
            $this->type = 'none';
            $matchedRoute = false;
        }

        // Return the matched route (false if none could be found)
        return $matchedRoute;
    }

    /**
     * Check the conf.router.php file for a matching route
     * @param $routePath the route to be matched
     * @return bool|string the configured route if one could be found, false otherwise
     */
    private function isConfiguredRoute($routePath) {

        // Go through all configured routes
        foreach(RouterConfig::getInstance()->getRoutes() as $route) {
            if(isset($route['origin']) && isset($route['destination']) && isset($route['wrap'])) {

                // Compare each to the route entered by the user
                if($route['origin'] == $routePath) {

                    // Check if the route file actually exists
                    if(file_exists($route['destination'])) {
                        $this->setWrap($route['wrap']);
                        return $route['destination'];
                    }
                    else {
                        Logger::getInstance()->writeMessage('Unable to find configured route: ' . $route['destination']);
                    }
                }
            }
        }

        // Return false if no configured route could be found
        return false;
    }

    /**
     * Check route for a valid image call
     * A valid call example: image/200x300/img/democms.jpg
     * @param $route the route to be matched
     * @return bool|string the image if one could be found, false otherwise
     */
    private function isImage($route) {

        // See if url starts with image
        if(isset($route[0]) && $route[0] == 'image') {

            // See if supplied image is a direct path (without dimenision parameters)
            $imagepath = implode('/', $route);
            if(file_exists($imagepath)) {

                // No image details need to be used
                $this->imageDetails = false;
                return $imagepath;
            }

            // Check for right amount of parameters
            else if(count($route) >= 3) {

                // If a width and height can be found
                $dimensions = explode('x', $route[1]);
                if(count($dimensions) == 2) {

                    // Set parameters for futher use
                    $this->imageDetails = array(
                        'width' => $dimensions[0],
                        'height' => $dimensions[1],
                    );

                    // Return image url
                    return implode('/', array_slice($route, 2));
                }
            }
        }

        // Return false if no image could be found
        return false;
    }

    /**
     * Check the conf.includes.php file for any includes
     * @param $routePath the route to be matched
     * @return bool|string the include if one could be found, false otherwise
     */
    private function isInclude($routePath) {

        // Compare includes to the routePath
        foreach(IncludesConfig::getInstance()->getAllIncludes() as $include) {

            // Return a matched include
            if (strpos($routePath, $include) !== false) {
                return $include;
            }
        }

        // Return false if no include could be found
        return false;
    }

    private function isModule($route) {

        // See if url starts with module
        if(isset($route[0]) && $route[0] == 'module') {

            // If a module main page is called
            if(count($route) == 2 || count($route) == 3 || count($route) == 4) {

                // See if the called module exists
                if($moduleName = ModuleManager::getInstance()->isModule($route[1])) {
                    $this->moduleDetails = array(
                        'module' =>   $moduleName
                    );

                    // Module main page
                    if(count($route) == 2) {
                        $this->moduleDetails['view'] = 'multi';
                    }

                    // Module details page
                    if(count($route) == 3) {

                        // Module single view
                        if(is_numeric($route[2])) {
                            $this->moduleDetails['view'] = 'single';
                            $this->moduleDetails['itemid'] = $route[2];
                        }

                        // Add a new module item
                        if($route[2] == 'new') {
                            $this->moduleDetails['action'] = 'new';
                        }
                    }

                    // Delete a specific module item
                    if(count($route) == 4) {
                        if($route[2] == 'delete') {
                            $this->moduleDetails['action'] = 'delete';
                            $this->moduleDetails['itemid'] = $route[3];
                        }
                    }
                }
            }

            // Show an overview of all modules
            else if(count($route) == 1) {
                $this->moduleDetails['view'] = 'overview';
            }
        }

        // Return true if a route could be found
        if(isset($this->moduleDetails['action']) || isset($this->moduleDetails['view'])) {
            return true;
        }
        else {
            return false;
        }

    }

    /**
     * Check if the requested route is a page in the /php/pages/ folder
     * @param $routePath the requested route
     * @return bool|string the route if one could be found, false otherwise
     */
    private function isPage($routePath) {

        // Use index.php if route is the root
        if($routePath == '') {
            $routePath = 'index.php';
        }

        // Add .php extension if not present
        if(pathinfo($routePath, PATHINFO_EXTENSION) == '') {
            $routePath .= '.php';
        }

        // See if a page route exists
        $pageRoute = 'php/pages/' . $routePath;
        if(file_exists($pageRoute)) {
            return $pageRoute;
        }

        // Return false if no file could be found
        return false;

    }

} 