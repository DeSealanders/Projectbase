<?php
/**
 * Class IncludesConfig
 * This class is responsible for maintaining a list of css and js includes
 */
class IncludesConfig extends Singleton {

    private $cssIncludes;
    private $jsIncludes;
    private $defaultIncludes;

    /**
     * The constructor contains a list of all includes which should be printed by the IncludeLoader
     */
    protected function __construct() {

        // Start of with two empty arrays
        $this->cssIncludes = $this->jsIncludes = array();

        /*
         * --- Configuration options here ---
         */

        // Setup default includes
        $this->setDefaultIncludes(array(
                'jquery' => true,
                'twitterbootstrap' => false,
                'fontawesome' => true,
                'lightbox' => true
            ));

        // Add all Javascript includes here
        $this->addJsInclude('js/documentready.js');
        $this->addJsInclude('js/index.js');
        $this->addJsInclude('https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js');
        $this->addJsInclude('js/jhtmlarea.js');
        $this->addJsInclude('js/texteditor.js');
        $this->addJsInclude('js/colpick.js');
        $this->addJsInclude('js/colorpicker.js');
        $this->addJsInclude('js/forms.js');

        // Add all Css includes here
        $this->addCssInclude('css/variables.php.css');
        $this->addCssInclude('css/default.css');
        $this->addCssInclude('css/forms.css');
        $this->addCssInclude('css/content.css');
//        $this->addCssInclude('css/experiment.css');
        $this->addCssInclude('css/jhtmlarea.css');
        $this->addCssInclude('css/module.css');
        $this->addCssInclude('css/colpick.css');

        /*
         * --- End of configuration options ---
         */

    }

    /**
     * Function for creating only 1 instance and return that each time its called (singleton)
     * @return IncludesConfig
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new IncludesConfig();
        }
        return $instance;
    }

    /**
     * This function loads the default includes (often used plugins like jquery)
     * @param $includes a list of plugins to be included
     */
    private function setDefaultIncludes($includes) {
        $this->defaultIncludes = $includes;

        // Setup the default includes list
        $includelist = array(
            'jquery' => array(
                'js' => 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'
            ),
            'twitterbootstrap' => array(
                'css' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css',
                'js' =>  'https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'
            ),
            'fontawesome' => array(
                'css' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'
            ),
            'lightbox' => array(
                'css' => 'css/lightbox.css',
                'js' => 'js/lightbox.js'
            )
        );

        // Include each plugin specified in $include
        foreach($includes as $include => $doInclude) {

            // Only include when specified so
            if($doInclude) {

                // Loop through all default includes and match it to the specified include
                foreach($includelist as $name => $includePaths) {
                    if($include == $name) {

                        // Add each file required by the plugin
                        foreach($includePaths as $type => $path) {

                            // Include specified js files
                            if($type == 'js') {
                                $this->addJsInclude($path);
                            }

                            // Include specified css files
                            else if($type = 'css') {
                                $this->addCssInclude($path);
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Add a specified js file to the includes list
     * @param $file the js file to be included
     */
    private function addJsInclude($file) {
        $this->jsIncludes[] = $file;
    }

    /**
     * Add a specified css file to the includes list
     * @param $file the css file to be included
     */
    private function addCssInclude($file) {
        $this->cssIncludes[] = $file;
    }

    /**
     * Getter for all css includes
     * @return array list of css includes
     */
    public function getCssIncludes() {
        return $this->cssIncludes;
    }

    /**
     * Getter for all js includes
     * @return array list of js includes
     */
    public function getJsIncludes() {
        return $this->jsIncludes;
    }

    /**
     * Getter for JS and CSS includes
     * @return array list of all js and css includes
     */
    public function getAllIncludes() {
        return array_merge($this->getJsIncludes(), $this->getCssIncludes());
    }

    /**
     * Search through all default includes to see if a plugin is enabled
     * @param $pluginName the name of the plugin for which will be determined wether or not it is enabled
     * @return bool true if enabled, false otherwise
     */
    public function isEnabled($pluginName) {
        foreach($this->defaultIncludes as $name => $doInclude) {
            if($pluginName == $name) {
                return $doInclude;
            }
        }
        return false;
    }
}


?>