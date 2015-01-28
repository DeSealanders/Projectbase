<div class="single">
<?php

// Retrieve the record for this view
$record = $this->module->getRecord($itemid);

// Create a form for all module components
$form = new Form($this->module->getName(), 'edit');
$form->addComponent(new CustomHtml('desc', '<p>' . $this->module->getDescription() . '</p>'));

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
    $form->addComponent(new ButtonGroup('buttons', array(
            new Button('Save', 'button', 'save'),
            new Button('Save & close', 'button', 'saveclose'),
            new Button('Close', 'button', 'close'),
        )));

}
else {
    $form->addComponent(new CustomHtml('error', '<p>This item could not be found</p>'));
}

// Show the form
$form->printHtml();
?>
</div>