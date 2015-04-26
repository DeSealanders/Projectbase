<div class="multi">
<?php
echo '<h2>' . $this->module->getName() . '</h2>';
echo '<p>'. $this->module->getDescription() . '</p>';

// Build a list of components
$components = array();
if($this->module->isAllowedEdit()) {
    $components['edit'] = 'edit';
}
$components['itemid'] = 'itemid';
$components = array_merge($components, $this->module->getMultiComponents());
if($this->module->isAllowedDelete()) {
    $components['delete'] = 'delete';
}

// Add headers for each component
echo '<table class="edit">';
echo '<tr>';
foreach($components as $componentName) {
    if($componentName == 'edit') {
        echo '<th class="edit"></th>';
    }
    else if($componentName == 'delete') {
        echo '<th class="delete"></th>';
    }
    else if($componentName == 'itemid') {
        echo '<th>Id</th>';
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

        // Create a table cell for each component
        foreach($components as $componentId => $componentLabel) {

            // Add an edit button to each row
            if($componentId  == 'edit') {
                $link = '/module/' . strtolower($this->module->getName()) . '/' . $record['itemid'];
                echo '<td><a href="' . $link . '"><span class="fa fa-edit fa-1x fa-fw"></span></a></td>';
            }

            // Add an edit button to each row
            else if($componentId  == 'delete') {
                $link = '/module/' . strtolower($this->module->getName()) . '/delete/' . $record['itemid'];
                echo '<td><a href="' . $link . '"><span class="fa fa-trash fa-1x fa-fw"></span></a></td>';
            }

            // Show the value for each component per row
            else if(isset($record[$componentId])) {
                echo '<td>' . $record[$componentId] . '</td>';
            }
            else {
                echo '<td></td>';
            }
        }
        echo '</tr>';
    }
}

// Add a button for new module items

if($this->module->isAllowedNew()) {
    $newLink = '/module/' . strtolower($this->module->getName()) . '/new';
    echo '<tr><td colspan="' .  count($components) . '">';
    echo '<a href="' . $newLink . '">';
    echo '<span class="fa fa-plus fa-1x fa-fw newentry"></span>';
    echo 'Add a new entry<td></a></tr>';
}

echo '</table>';
?>
</div>