<?php

/**
 * Class MultiDropdown
 * This class represents a dropdown menu in a generated form
 */
class MultiDropdown extends FormComponent{

    // An array of options with the key as label and the value as option
    private $options;

    public function __construct($label, $id, $options = array(), $selected = false, $required = false) {
        parent::__construct($id, $label, $required);
        $this->options = $options;
        $this->selected = $selected;
    }

    public function printHtml() {
        echo '<div class="component">';
        echo '<label for="'. $this->id . '">' . $this->label . $this->getRequiredLabelHtml() . '</label>';
        echo '<div class="inputwrapper">';

        if($this->selected) {
            $SelectedEntries = explode('|', $this->selected);
            foreach($SelectedEntries as $index => $selectedEntry) {
                $this->printMultiDropdown($this->options, $this->id, $selectedEntry, $this->required, $index);
            }
        }
        else {
            $this->printMultiDropdown($this->options, $this->id, $this->selected, $this->required);
        }

        echo '<p class="add"><a href="javascript:void(0)"><i class="fa fa-fw fa-plus"></i>Add more</a></p>';
        echo '</div>';
        echo '</div>';
    }

    private function printMultiDropdown($options, $id, $selected = false, $required = false, $index = 0) {
        echo '<div class="multidropdown">';

        // Build key value pairs of id and option
        foreach($options as $outerId => $outerNames) {
            foreach($outerNames as $name => $multioptions) {
                $outerOptions[$outerId] = $name;

                $innerOptions[$outerId] = $multioptions;
            }
        }

        // Prepare selected values
        if($selected) {
            $selectedValues = explode(',', $selected);
            $categoryValue = $selectedValues[0];
            $subValue = $selectedValues[1];
            $subOptions = $innerOptions[$selectedValues[0]];
        }
        else {
            $categoryValue = $subValue = $selected;
            $subOptions = array();
        }

        // Print dropdown with category options
        $this->printDropdown($outerOptions, $id, $id . '[' . $index . '][cat]', $categoryValue, $this->required);

        // Print an empty dropdown for the linked dropdown
        $this->printDropdown($subOptions, $id . '-id', $id . '[' . $index . '][sub]', $subValue);

        // Print javascript options so the linked dropdown can be filled dynamically
        ?>
        <script>
            addOptions("<?php echo $id; ?>", <?php echo json_encode($innerOptions, JSON_FORCE_OBJECT); ?>);
        </script>
        <?php

        if($index == 0) {
            $class = 'remove undeleteable';
        }
        else {
            $class = 'remove';
        }
        echo '<p class="'.  $class . '"><a href="javascript:void(0);"><i class="fa fa-fw fa-times"></i></a></p>';
        echo '</div>';
    }

    private function printDropdown($options, $id, $name, $selected = false, $required = false) {
        echo '<select autocomplete="off" ' . $this->getRequiredInputHtml() . ' name="' . $name . '" id="' . $id . '">';

        // If the dropdown is required add a first option without a value
        if($required) {
            $options = array('Select an option' => '') + $options;
        }

        // Print all values as an option
        foreach($options as $option => $label) {
            if(((is_bool($selected) && $selected) || !is_bool($selected)) && $selected == $option) {
                $selectedHtml = 'selected="selected"';
            }
            else {
                $selectedHtml = '';
            }
            echo '<option value="' . $option . '" ' . $selectedHtml . '>' . $label . '</option>';
        }
        echo '</select>';
    }

} 