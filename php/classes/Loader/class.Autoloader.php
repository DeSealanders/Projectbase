<?php
/**
 * Class Autoloader
 * This class is repsonsible for auto loading classes if enabled
 * It will check a list of directories and filenames to see wether a class can be found
 */
class Autoloader {

    private $autoloadActive;

    /**
     * The constructor disables autoloading by default
     */
    private function __construct() {
        $this->autoloadActive = false;
    }

    /**
     * Function for creating only 1 instance and return that each time its called (singleton)
     * @return Autoloader
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new Autoloader();
        }
        return $instance;
    }

    /**
     * This function is called whenever a classfile cannot be found while it is called
     * This function will then search for the specified class within the /php/ directory
     * @param $className the classname of the class which should be included
     */
    public function autoload($className) {
        if($this->autoloadActive) {
            // Folders to search
            $folders = $this->getSubfolders('php/');

            // Filesname to search for classes
            $filenames = array(
                'class' => 'class.' . $className . '.php'
            );

            // Also search for namespaced classes
            $array = explode('\\', $className);
            if(count($array) > 1) {
                $filenames['default'] = $array[count($array)-1] . '.php';
            }

            //Also search for config classes
            if(strpos($className, 'Config') != 0) {
                $filenames['config'] = 'conf.' . strtolower(substr($className, 0, strlen($className)-6)) . '.php';
            }

            // Loop all folder & filename combinations and include if a file is found
            foreach ($folders as $filepath) {
                foreach($filenames as $filename) {

                    // Include the correct file if it is found
                    if (file_exists($filepath . $filename)) {
                        include $filepath . $filename;
                        break;
                    }
                }
            }
        }
    }

    /**
     * Setter for wether or not to autoload classes
     * @param $value true if classes should be autoloaded, false otherwise
     */
    public function setAutoinclude($value) {
        $this->autoloadActive = $value;
    }

    /**
     * Recursively retrieve all subfolders for a specified folder
     * @param $folder the parent folder of which subfolders should be retrieved from
     * @return array a list of subfolders
     */
    private function getSubfolders($folder) {
        $folderList = array();
        foreach(scandir($folder) as $file) {
            $folderString = $folder . $file . '/';
            if(is_dir($folderString)) {
                if($file != '.' && $file != '..') {
                    $folderList[] = $folderString;
                    $folderList = array_merge($folderList, $this->getSubfolders($folderString));
                }
            }
        }
        return $folderList;
    }

} 