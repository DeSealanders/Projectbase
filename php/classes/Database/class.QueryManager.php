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

    public function saveUser($user, $hash) {
        $query = new Query();
        $query->insert('users', array('username' => $user->getUsername(), 'password' => $hash));
        return DatabaseManager::getInstance()->executeQuery($query);
    }

    public function getHashedPassword($username) {
        $query = new Query();
        $query->select('password');
        $query->from('users');
        $query->where('username = "' .  $username . '"');
        return DatabaseManager::getInstance()->executeQuery($query);
    }

    public function startSession($username, $sessionId) {
        $query = new Query();
        $query->insert('sessions', array(
                'username' => $username,
                'session_id' => $sessionId,
                'expires' => date('Y-m-d H:i:s', strtotime('+ 1 day')),
            ));
        DatabaseManager::getInstance()->executeQuery($query);
    }

    public function stopSession($sessionId) {
        $query = new Query();
        $query->delete('sessions');
        $query->where('session_id = "'. $sessionId . '"');
        DatabaseManager::getInstance()->executeQuery($query);
    }

    public function getUserFromSession($sessionId) {
        $query = new Query();
        $query->select('username');
        $query->from('sessions');
        $query->where('session_id = "' .  $sessionId . '"');
        $query->where('expires > "' . date('Y-m-d H:i:s') . '"');
        $result = DatabaseManager::getInstance()->executeQuery($query);
        if($result) {
            return reset($result);
        }
        else {
            return $result;
        }
    }
} 