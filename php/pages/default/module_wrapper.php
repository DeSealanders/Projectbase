<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
<?php

// Print all css and js includes
IncludeLoader::getInstance()->printIncludes();
?>
</head>
<body>

<div class="menu">
    <?php
    foreach(ModuleManager::getInstance()->getModuleList() as $moduleName) {
        echo '<a href="/projectbase/module/' . $moduleName . '">' . $moduleName . '</a>';
    }
    ?>
</div>
<div class="container">
    <?php
    // Load the specified module from the router
    ModuleManager::getInstance()->loadModule($_SERVER['ROUTE']['module']);
    if($module = ModuleManager::getInstance()->getModule($_SERVER['ROUTE']['module'])) {
        if($_SERVER['ROUTE']['view'] == 'multi') {
            echo $module->printBackendHtml('multi');
        }
        else if($_SERVER['ROUTE']['view'] == 'single') {
            echo $module->printBackendHtml('single', $_SERVER['ROUTE']['itemid']);
        }
    }
    ?>
</div>
</body>
</html>