<div class="multi">
<?php
echo '<h2>' . $this->module->getName() . '</h2>';


$components = array();
$components[] = 'edit';
$components[] = 'itemid';
$components = array_merge($components, $this->module->getMultiComponents());

// Add headers for each component
echo '<table class="edit">';
echo '<tr>';
foreach($components as $componentName) {
    if($componentName == 'edit') {
        echo '<th class="edit"></th>';
    }
    else {
        echo '<th>' . ucfirst($componentName) . '</th>';
    }
}
echo '</tr>';

// If any records exist, create a table row for each one
if($records = $this->module->getCleanRecords()) {
    foreach($records as $record) {
        echo '<tr>';
        foreach($components as $component) {

            // Add an edit button to each row
            if($component  == 'edit') {
                $link = '/projectbase/module/' . strtolower($this->module->getName()) . '/' . $record['itemid'];
                echo '<td><a href="' . $link . '"><span class="fa fa-edit fa-1x fa-fw"></span></a></td>';
            }

            // Show the value for each component per row
            if(isset($record[$component])) {
                echo '<td>' . $record[$component] . '</td>';
            }
        }
        echo '</tr>';
    }
}
echo '</table>';
?>
</div>