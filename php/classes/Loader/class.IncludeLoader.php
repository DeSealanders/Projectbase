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
        if(IncludesConfig::getInstance()->shouldMinify()) {
            $this->printCssMinified();
            $this->printJsMinified();
        }
        else {
            $this->printCssIncludes();
            $this->printJsIncludes();
        }

    }


    /**
     * Print all css includes from conf.includes.php
     */
    private function printCssIncludes($includes = false) {
        if($includes) {
            foreach($includes as $include) {
                echo "\t" . '<link rel="stylesheet" type="text/css" href="' . $include . '">' . "\n";
            }
        }
        else {
            $includes = IncludesConfig::getInstance()->getCssIncludes();
            foreach($includes as $include) {
                if($this->isLocal($include)) {
                    echo "\t" . '<link rel="stylesheet" type="text/css" href="/impressentation/css/' . $include . '">' . "\n";
                }
                else {
                    echo "\t" . '<link rel="stylesheet" type="text/css" href="' . $include . '">' . "\n";
                }
            }
        }
    }

    /**
     * Print all js includes from conf.includes.php
     */
    private function printJsIncludes($includes = false) {
        if($includes) {
            foreach($includes as $include) {
                echo "\t" . '<script src="' . $include . '"></script>' . "\n";
            }
        }
        else {
            $includes = IncludesConfig::getInstance()->getJsIncludes();
            foreach($includes as $include) {
                if($this->isLocal($include)) {
                    echo "\t" . '<script src="/impressentation/js/' . $include . '"></script>' . "\n";
                }
                else {
                    echo "\t" . '<script src="' . $include . '"></script>' . "\n";
                }
            }
        }
    }

    private function printCssMinified() {
        $includes = IncludesConfig::getInstance()->getCssIncludes();
        $splitIncludes = $this->splitIncludes($includes);

        // Print live includes
        if(isset($splitIncludes['live']) && count($splitIncludes['live']) > 0) {
            $this->printCssIncludes($splitIncludes['live']);
        }

        // Print local includes
        if(isset($splitIncludes['local']) && count($splitIncludes['local']) > 0) {
            $includeText = implode(',', $splitIncludes['local']);
            echo "\t" . '<link type="text/css" rel="stylesheet" href="/impressentation/min/b=impressentation/css&amp;f=' . $includeText . '" />'. "\n";
        }
    }

    private function printJsMinified() {
        $includes = IncludesConfig::getInstance()->getJsIncludes();
        $splitIncludes = $this->splitIncludes($includes);

        // Print live includes
        if(isset($splitIncludes['live']) && count($splitIncludes['live']) > 0) {
            $this->printJsIncludes($splitIncludes['live']);
        }

        // Print local includes
        if(isset($splitIncludes['local']) && count($splitIncludes['local']) > 0) {
            $includeText = implode(',', $splitIncludes['local']);
            echo "\t" . '<script type="text/javascript" src="/impressentation/min/b=impressentation/js&amp;f=' . $includeText . '"></script>'. "\n";
        }
    }

    private function splitIncludes($includeList) {

        $includes['local'] = array();
        foreach($includeList as $include) {
            if($this->isLocal($include)) {
                $includes['local'][] = $include;
            }
            else {
                $includes['live'][] = $include;
            }
        }
        return $includes;
    }

    private function isLocal($include) {
        if(count(parse_url($include)) > 1) {
            return false;
        }
        else {
            return true;
        }
    }

} 