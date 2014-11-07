<?php

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

    public function printIncludes() {
        $this->printCssIncludes();
        $this->printJsIncludes();
    }

    private function printCssIncludes() {
        foreach($this->includeConfig->getCssIncludes() as $file) {
            if(file_exists($file)) {
                echo "\t" . '<link rel="stylesheet" type="text/css" href="' . $file . '">' . "\n";
            }
            else {
                Throw new Exception('Unable to find specified include: ' . $file);
            }
        }
    }

    private function printJsIncludes() {
        foreach($this->includeConfig->getJsIncludes() as $file) {
            if(count(parse_url($file)) > 1 || file_exists($file)) {
                echo "\t" . '<script src="' . $file . '"></script>' . "\n";
            }
            else {
                Throw new Exception('Unable to find specified include: ' . $file);
            }
        }
    }

} 