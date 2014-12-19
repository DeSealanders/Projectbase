<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
<?php
// Print all css and js includes
IncludeLoader::getInstance()->printIncludes();
?>
<?php
if(isset($_SERVER['ROUTE']['module']))
{
    $title = ucfirst($_SERVER['ROUTE']['module']);
}
else if(isset($_SERVER['ROUTE']['view']) && $_SERVER['ROUTE']['view'] == 'overview') {
    $title = 'Overview';
}
echo '<title>' . $title . '</title>';
?>
</head>
<body>
<div class="backend">
    <div class="menu">
        <ul>
        <?php
        if($_SERVER['ROUTE']['view'] == 'overview') {
            $class = 'active';
        }
        else {
            $class = '';
        }
        echo '<li class="overview ' . $class . '"><a href="/projectbase/module"><i class="fa fa-fw fa-home"></i>Overview</a></li>';
        foreach(ModuleManager::getInstance()->getModuleList() as $moduleName) {
            if(isset($_SERVER['ROUTE']['module']) && $moduleName == $_SERVER['ROUTE']['module']) {
                $class = 'active';
            }
            else {
                $class = '';
            }
            echo '<li class=' . $class . '><a class="padded" href="/projectbase/module/' . $moduleName . '">' . ucfirst($moduleName) . '</a></li>';
        }
        ?>
        </ul>
    </div>
    <div class="container">
        <?php

        // Save module data if anything is posted
        if(!empty($_POST) && isset($_POST['button'])) {
            if($_POST['button'] == 'close') {
                header('location: /projectbase/module/' . $_SERVER['ROUTE']['module']);
                die('redirecting');
            }
            else if($_POST['button'] == 'save') {
                ModuleManager::getInstance()->saveItem($_SERVER['ROUTE']['module'], $_SERVER['ROUTE']['itemid']);
            }
            else if($_POST['button'] == 'saveclose') {
                ModuleManager::getInstance()->saveItem($_SERVER['ROUTE']['module'], $_SERVER['ROUTE']['itemid']);
                header('location: /projectbase/module/' . $_SERVER['ROUTE']['module']);
                die('redirecting');
            }
        }

        // Check for a specified action
        if(isset($_SERVER['ROUTE']['action'])) {

            // Create a new entry and redirect to single view
            if($_SERVER['ROUTE']['action'] == 'new') {
                $itemId = ModuleManager::getInstance()->newItem($_SERVER['ROUTE']['module']);
                header('location: /projectbase/module/' . $_SERVER['ROUTE']['module'] . '/' . $itemId);
                die('redirecting');
            }

            // Delete specified entry and redirect to multi view
            else if($_SERVER['ROUTE']['action'] == 'delete') {
                ModuleManager::getInstance()->deleteItem($_SERVER['ROUTE']['module'], $_SERVER['ROUTE']['itemid']);
                header('location: /projectbase/module/' . $_SERVER['ROUTE']['module']);
                die('redirecting');
            }
        }

        // Show the module overview if specified
        if($_SERVER['ROUTE']['view'] == 'overview') {
            require('backend.php');
        }

        // Load the module (including data) specified by the router
        if(isset($_SERVER['ROUTE']['module'])) {
            ModuleManager::getInstance()->loadModule($_SERVER['ROUTE']['module']);

            // Get the loaded module if everything went correctly
            if($module = ModuleManager::getInstance()->getModule($_SERVER['ROUTE']['module'])) {

                // Load the correct layout file
                if($_SERVER['ROUTE']['view'] == 'multi') {
                    if(!$module->isAllowedDelete() && !$module->isAllowedNew() && $module->isAllowedEdit() && $record = $module->getSingleRecord()) {
                        echo $module->printBackendHtml('single', $record['itemid']);
                    }
                    else {
                        echo $module->printBackendHtml('multi');
                    }
                }
                else if($_SERVER['ROUTE']['view'] == 'single') {
                    echo $module->printBackendHtml('single', $_SERVER['ROUTE']['itemid']);
                }
            }
            else {
                Logger::getInstance()->writeMessage('Could not load module: ' . $module);
            }
        }

        ?>
    </div>
</div>
</body>
</html>