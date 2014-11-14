<?php
/**
 * Class QueryBuilder
 * This class is responsible for building up queries
 */
class QueryBuilder {

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
            $instance = new QueryBuilder();
        }
        return $instance;
    }

    public function buildInsert($table, $data) {

        // Insert into people
        $sql = "INSERT INTO " . $table;

        // (firstname, lastname, dob, email)
        $sql .= " (" . implode(', ', array_keys($data)) . ")";

        // VALUES (?, ?, ?, ?);
        $sql .= " VALUES (" . implode(', ', array_fill(0, count($data), '?')) . ");";

        // array('Henk', 'De tank', '26-10-1991', 'henk@tank.de');
        $params = array_values($data);

        // Save into a query object for easy data retrieval
        return new Query($sql, $params);
    }
} 