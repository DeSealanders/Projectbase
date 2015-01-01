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
                $this->currentUser = new User($username, $hash[0]['password']);
                return true;
            }
            else {
                return false;
            }
        }
    }

    public function getCurrentUser() {
        return $this->currentUser;
    }

    public function createUser($username, $password) {
        if($hash = password_hash($password, PASSWORD_BCRYPT)) {
            $user = new User($username, $hash);
            QueryManager::getInstance()->saveUser($user);
        }
        else {
            Logger::getInstance()->writeMessage('Error creating user hash');
        }
    }

} 