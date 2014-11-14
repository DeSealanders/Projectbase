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

    /*
     *
     * ---------------------- Examples ----------------------
     *
     *
     */

    public function saveEvent() {
        $data = array(
            'firstname' => 'Henk',
            'lastname' => 'De tank',
            'dob' => '26-10-1991',
            'email' => 'henk@tank.de'
        );
        $query = QueryBuilder::getInstance()->buildInsert('people', $data);
        return DatabaseManager::getInstance()->executeQuery($query->getSql() , $query->getParameters());
    }

    public function saveEventOld() {
        $query = 'INSERT INTO people (firstname, lastname, dob, email) VALUES (?, ?, ?, ?);';
        $params = array(
            'Henk',
            'De tank',
            '26-10-1991',
            'henk@tank.de'
        );
        return DatabaseManager::getInstance()->executeQuery($query , $params);

    }


} 