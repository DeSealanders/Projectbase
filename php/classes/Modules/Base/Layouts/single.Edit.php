<div class="single">
<?php

// Retrieve the record for this view
$record = $this->module->getRecord($itemid);

// Create a form for all module components
$form = new Form($this->module->getName(), 'edit');
$form->addComponent(new CustomHtml('desc', '<p>' . $this->module->getDescription() . '</p>'));
$formComponents = array();

if($record) {


    $sortedFormComponents = array();
    foreach($this->module->getComponents() as $component) {
        if($group = $component->getGroup()) {
            $sortedFormComponents[$group][] = $component;
        }
        else {
            $sortedFormComponents[$component->getId()] = $component;
        }
    }

    // Add all components to the form
    foreach($sortedFormComponents as $component) {

        if(is_array($component)) {
            var_dump($component[0]->getGroup());

            //TODO add form group
            foreach($component as $subId => $subComponent) {

                // Loop through all record fields
                foreach($record as $field => $value) {

                    // Only add components if they are present in the database record
                    if($field == strtolower($subComponent->getId())) {

                        // Add a formcomponent to the form
                        $form->addComponent($subComponent->getFormComponent($value));
                    }
                }
            }
        }
        else {

            // Loop through all record fields
            foreach($record as $field => $value) {

                // Only add components if they are present in the database record
                if($field == strtolower($component->getId())) {

                    // Add a formcomponent to the form
                    $form->addComponent($component->getFormComponent($value));
                }
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