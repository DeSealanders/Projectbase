<?php

// Render projects list
ModuleManager::getInstance()->loadModule('Slides');
$projectModule = ModuleManager::getInstance()->getModule('Slides');
$projectModule->printFrontendHtml('multi');