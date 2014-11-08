<?php
/**
 * Class IncludeLoader
 * This class is responsible for loading all css and js includes from conf.includes.php
 */
class IncludeLoader {

    private function __construct() {
        $this->includeConfig = new IncludesConfig();
    }

    /**
     * Function for creating only 1 instance and return that each time its called (singleton)
     * @return IncludeLoader
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new IncludeLoader();
        }
        return $instance;
    }

    /**
     * This function prints all js and css includes specified in conf.includes.php
     */
    public function printIncludes() {
        $this->printCssIncludes();
        $this->printJsIncludes();
    }


    /**
     * Print all css includes from conf.includes.php
     */
    private function printCssIncludes() {
        foreach($this->includeConfig->getCssIncludes() as $file) {
            if(file_exists($file)) {
                echo "\t" . '<link rel="stylesheet" type="text/css" href="' . $file . '">' . "\n";
            }
            else {
                Logger::getInstance()->writeMessage('Unable to find specified include: ' . $file);
            }
        }
    }

    /**
     * Print all js includes from conf.includes.php
     */
    private function printJsIncludes() {
        foreach($this->includeConfig->getJsIncludes() as $file) {
            if(count(parse_url($file)) > 1 || file_exists($file)) {
                echo "\t" . '<script src="' . $file . '"></script>' . "\n";
            }
            else {
                Logger::getInstance()->writeMessage('Unable to find specified include: ' . $file);
            }
        }
    }

} 