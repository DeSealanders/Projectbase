<?php

// Render slideshows list
ModuleManager::getInstance()->loadModule('Slideshows');
$slideshowsModule = ModuleManager::getInstance()->getModule('Slideshows');
$slideshowsModule->printFrontendHtml('multi');

?>