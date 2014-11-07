<?php

/**
 * Magic function called whenever an unknown class is to be loaded
 * @param $className
 */
function __autoload($className)
{
    require_once('php/classes/Loader/class.Autoloader.php');
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