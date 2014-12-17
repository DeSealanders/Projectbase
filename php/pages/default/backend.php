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
<div class="backend overview">
    <h1>Modulebeheer</h1>
    <?php
    $previewList = ModuleManager::getInstance()->getPreviewList();
    foreach($previewList as $module) {
        echo '<a href="/projectbase/module/' . strtolower($module->getName()) . '">';
        echo '<div class="moduleBlock">';
        echo '<h2>' . ucfirst($module->getName()) . '</h2>';
        echo '<p>' . $module->getDescription() . '</p>';
        echo '<table>';
        echo '<tr><th>Layouts</th><th>Columns</th></tr>';
        echo '<tr>';
        echo  '<td>' . implode(', ', array_map('ucfirst', array_keys($module->getLayouts()))) . '</td>';
        echo  '<td>' . implode(', ', array_map('ucfirst', array_keys($module->getComponentNames()))) . '</td>';
        echo '</table>';
        echo '</div>';
        echo '</a>';
    }
    ?>
    </div>
</body>
</html>