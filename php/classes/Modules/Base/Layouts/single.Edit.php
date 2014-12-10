<?php

// Retrieve the record for this view
$record = $this->module->getRecord($itemid);

// Create a form for all module components
$form = new Form('Single Edit', 'edit');

// Add all components to the form
foreach($this->module->getComponents() as $component) {

    // Loop through all record fields
    foreach($record as $field => $value) {

        // Only add components if they are present in the database record
        if($field == strtolower($component->getId())) {

            // Add a formcomponent to the form
            $form->addComponent($component->getFormCompontent($value));
        }
    }
}

// Add a save button
$form->addComponent(new Button('Save', 'save'));

// Show the form
$form->printHtml();