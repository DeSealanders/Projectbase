<?php

/**
 * Magic function called whenever an unknown class is to be loaded
 * This function will then call the autoloader which will include this file if configured so
 * @param $className
 */
function __autoload($className)
{
    Autoloader::getInstance()->autoload($className);
}

/**
 * Check if live or local by ip
 * @return bool true if live, false of local
 */
function isLive()
{
    if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::1') {
        return false;
    }
    return true;
}

/**
 * Creates a file path if for a specified file if it does not exist yet
 * @param $file the file for which the folder structure should be created
 */
function createIfNotExists($file) {

    // Retrieve detailed information about the specified file
    $pathinfo = pathinfo($file);

    // Retrieve the folder path
    $folderstructure = $pathinfo['dirname'];

    // Create the folder path if it does not exist yet
    if (!file_exists($folderstructure)) {
        mkdir($folderstructure, 0777, true);
    }
}