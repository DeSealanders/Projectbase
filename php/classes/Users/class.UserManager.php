<?php

class UserManager extends Singleton {

    private $currentUser;

    protected function __construct() {
        $this->currentUser = false;
    }

    public function login($username, $password) {
        $hash = QueryManager::getInstance()->getHashedPassword($username);
        if($hash && isset($hash[0])) {
            if(password_verify($password, $hash[0]['password'])) {
                $this->currentUser = new User($username);
                session_regenerate_id();
                QueryManager::getInstance()->startSession($username, session_id());
                return true;
            }
            else {
                return false;
            }
        }
    }

    public function logout() {
        QueryManager::getInstance()->stopSession(session_id());
        session_destroy();
    }

    public function getCurrentUser() {

        // If no user has already been set (by the login function)
        if(!$this->currentUser) {

            // Check database for active sessions
            if($user = QueryManager::getInstance()->getUserFromSession(session_id())) {
                $this->currentUser = new User($user['username']);
            }
        }
        return $this->currentUser;
    }

    public function createUser($username, $password) {
        if($hash = password_hash($password, PASSWORD_BCRYPT)) {
            $user = new User($username);
            QueryManager::getInstance()->saveUser($user, $hash);
        }
        else {
            Logger::getInstance()->writeMessage('Error creating user hash');
        }
    }

} 