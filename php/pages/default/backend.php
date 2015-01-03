<div class="overview">
    <h2>Module overview</h2>
    <table>
        <tr>
            <th class="edit"></th>
            <th>Module</th>
            <th>Description</th>
        </tr>
    <?php
    $previewList = ModuleManager::getInstance()->getPreviewList();
    foreach($previewList as $module) {
        echo '<tr>';
        echo '<td><a href="/projectbase/module/' . strtolower($module->getName()) . '">';
        echo '<span class="fa fa-fw fa-external-link"></a></td>';
        echo '<td>' . ucfirst($module->getName()) . '</td>';
        echo '<td>' . $module->getDescription() . '</td>';
        //echo  '<td>' . implode(', ', array_map('ucfirst', array_keys($module->getLayouts()))) . '</td>';
        //echo  '<td>' . implode(', ', array_map('ucfirst', array_keys($module->getComponentNames()))) . '</td>';
        echo '</tr>';
    }
    ?>
    </table>
</div>