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
<div class="backend">
    <div class="menu">
        <ul>
        <?php
        foreach(ModuleManager::getInstance()->getModuleList() as $moduleName) {
            echo '<li><a href="/projectbase/module/' . $moduleName . '">' . ucfirst($moduleName) . '</a></li>';
        }
        ?>
        </ul>
    </div>
    <div class="container">
        <?php
        // Load the specified module from the router
        if(!empty($_POST)) {
            ModuleManager::getInstance()->loadModule($_SERVER['ROUTE']['module'], $_SERVER['ROUTE']['itemid']);
        }
        else {
            ModuleManager::getInstance()->loadModule($_SERVER['ROUTE']['module']);
        }

        // Load the correct layout item
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
</div>
</body>
</html>