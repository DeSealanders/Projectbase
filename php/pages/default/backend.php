<?php

echo '<ul>';
foreach(ModuleManager::getInstance()->getModuleList() as $moduleName) {
    echo '<li><a href="/projectbase/module/' . $moduleName . '">' . $moduleName . '</a></li>';
}
echo '</ul>';