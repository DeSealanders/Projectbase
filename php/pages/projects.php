<?php

echo '<h1>Projecten</h1>';
echo '<p>Op deze pagina zijn enkele projecten te vinden</p>';

// Render projects list
ModuleManager::getInstance()->loadModule('Projects');
$projectModule = ModuleManager::getInstance()->getModule('Projects');
$projectModule->printFrontendHtml('multi');