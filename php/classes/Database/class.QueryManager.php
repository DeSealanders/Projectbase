<?php
/**
 * Class QueryManager
 * This class is responsible for executing all database queries
 */
class QueryManager {

    private function __construct() {

    }

    /**
     * Function for creating only 1 instance and return that each time its called (singleton)
     * @return DatabaseManager
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new QueryManager();
        }
        return $instance;
    }

    /**
     * Save the debugreport array to the database
     * @param $debugreport the array which will be inserted in the database
     * @return array|null true if executed successfully
     */
    public function saveDebugReport($debugreport) {

        // Create an insert statement based on input array
        $query = QueryBuilder::getInstance()->buildInsert('debug', $debugreport);
        return DatabaseManager::getInstance()->executeQuery($query->getSql() , $query->getParameters());
    }
} 