<?php
echo '<h1>Multi edit</h1>';

echo '<table>';
echo '<tr>';

$components = array();
$components[] = 'edit';
$components[] = 'itemid';
foreach($this->module->getComponents() as $component) {
    $components[] = strtolower($component->getId());
}

foreach($components as $component) {
    echo '<th>' . ucfirst($component) . '</th>';
}
echo '</tr>';

if($records = $this->module->getRecords()) {
    foreach($records as $record) {
        echo '<tr>';
        foreach($components as $component) {
            if($component == 'edit') {
                $link = '/projectbase/module/' . strtolower($this->module->getName()) . '/' . $record['itemid'];
                echo '<td><a href="' . $link . '"><span class="fa fa-edit fa-1x fa-fw"></span></a></td>';
            }
            else {
                if(isset($record[$component])) {
                    echo '<td>' . $record[$component] . '</td>';
                }
            }
        }
        echo '</tr>';
    }
}
echo '</table>';