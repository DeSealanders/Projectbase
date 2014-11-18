<?php
// Load default config
require_once('php/config/conf.default.php');
DefaultConfig::getInstance()->init();

// Route the incoming request via the router
Router::getInstance()->route($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']);

// Display logged messages (only on dev)
if(!isLive()) {
    Logger::getInstance()->printMessages();
}
?>