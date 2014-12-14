<div class="single">
<?php

// Retrieve the record for this view
$record = $this->module->getRecord($itemid);

// Create a form for all module components
$form = new Form($this->module->getName(), 'edit');

if($record) {

    // Add all components to the form
    foreach($this->module->getComponents() as $component) {
        // Loop through all record fields
        foreach($record as $field => $value) {

            // Only add components if they are present in the database record
            if($field == strtolower($component->getId())) {

                // Add a formcomponent to the form
                $form->addComponent($component->getFormComponent($value));
            }
        }
    }

    // Add a save button
    $form->addComponent(new Button('Save', 'save'));

}
else {
    $form->addComponent(new CustomHtml('error', '<p>This item could not be found</p>'));
}

// Show the form
$form->printHtml();
?>
</div>