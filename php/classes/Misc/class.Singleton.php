<?php
/**
 * Class Singleton
 * This class is used to only create 1 instance of an object
 * When one is previously created it will be returned instead
 */
abstract class Singleton
{

    protected function __construct()
    {

    }

    /**
     * Retrieve an object of a specific class
     * @return mixed object of the class extending the singleton
     */
    public static function getInstance()
    {
        // Get the classname of the object which is the actual singleton
        $calledClass = get_called_class();
        static $instance = null;

        // Create a new object of that class if none has been created already
        if (null === $instance) {
            $instance = new $calledClass();
        }

        // Return the (created) object
        return $instance;
    }
}
?>