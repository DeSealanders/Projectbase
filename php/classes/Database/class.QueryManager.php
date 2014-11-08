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

    public function saveEvent(Event $event) {
        $query = "INSERT INTO events (itemid, name, description, location, startDate, endDate, userid) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $params = array(
            $event->getId(),
            $event->getName(),
            $event->getDescription(),
            $event->getLocation(),
            $event->getStart(),
            $event->getEnd(),
            $event->getUserid()
        );
        return DatabaseManager::getInstance()->executeQuery($query , $params);
    }

    public function getEventIds() {
        $query = "SELECT itemid FROM events";
        return DatabaseManager::getInstance()->executeQuery($query);
    }


} 