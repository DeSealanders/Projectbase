<?php
/**
 * Class IncludeLoader
 * This class is responsible for loading all css and js includes from conf.includes.php
 */
class IncludeLoader extends Singleton {

    protected function __construct() {

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
        foreach(IncludesConfig::getInstance()->getCssIncludes() as $file) {
            if(count(parse_url($file)) > 1 || file_exists($file)) {
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
        foreach(IncludesConfig::getInstance()->getJsIncludes() as $file) {
            if(count(parse_url($file)) > 1 || file_exists($file)) {
                echo "\t" . '<script src="' . $file . '"></script>' . "\n";
            }
            else {
                Logger::getInstance()->writeMessage('Unable to find specified include: ' . $file);
            }
        }
    }

} 