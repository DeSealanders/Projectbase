<?php



// Load default config
require_once('php/config/conf.default.php');
DefaultConfig::getInstance()->init();

session_name('id');
session_start();

$injection = "Jansen' OR 'a' = 'a";
$query = new Query();
$query->select('*');
$query->from('users');
$query->where('password = ' . "'" . $injection . "'");
echo $query;

// Todo fix!
var_dump(DatabaseManager::getInstance()->executeQuery($query));
var_dump(DatabaseManager::getInstance()->executeQuery("SELECT * FROM users WHERE password = ?", array($injection)));

// Route the incoming request via the router
Router::getInstance()->route($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']);

// Display logged messages (only on dev)
if(!isLive()) {
    Logger::getInstance()->printMessages();
}
?>