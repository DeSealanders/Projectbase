<?php
/**
 * Class QueryManager
 * This class is responsible for executing all database queries
 * It will be filled with queries with project specific purposes
 */
class QueryManager extends Singleton {

    protected function __construct() {

    }

    /**
     * Save the debugreport array to the database
     * @param $debugreport the array which will be inserted in the database
     * @return array|null true if executed successfully
     */
    public function saveDebugReport($debugreport) {

        // Create an insert statement based on input array
        $query = new Query();
        $query->insert('debug', $debugreport);
        return DatabaseManager::getInstance()->executeQuery($query);
    }

    public function saveUser($user) {
        $query = new Query();
        $query->insert('users', array('username' => $user->getUsername(), 'password' => $user->getPassword()));
        return DatabaseManager::getInstance()->executeQuery($query);
    }

    public function getHashedPassword($username) {
        $query = new Query();
        $query->select('password');
        $query->from('users');
        $query->where('username = "' .  $username . '"');
        return DatabaseManager::getInstance()->executeQuery($query);
    }
} 