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
        $this->selected = 1;
    }

    public function printHtml() {
        echo '<div class="component">';
        echo '<label for="'. $this->id . '">' . $this->label . $this->getRequiredLabelHtml() . '</label>';
        echo '<div class="inputwrapper">';
        echo '<div class="multidropdown">';

        if($this->hasMultipleOptions($this->options)) {
            foreach($this->options as $outerId => $outerNames) {
                foreach($outerNames as $name => $options) {
                    $outerOptions[$outerId] = $name;

                    $innerOptions[$outerId] = $options;
                }
            }
            $this->printDropdown($outerOptions, $this->id, $this->id . '[0][module]', $this->selected, $this->required);
            $this->printDropdown(array(), $this->id . '-id', $this->id . '[0][itemid]');
            ?>
            <script>
                addOptions("<?php echo $this->id; ?>", <?php echo json_encode($innerOptions, JSON_FORCE_OBJECT); ?>);
            </script>
            <?php
        }
        else {
            $this->printDropdown($this->options, $this->id, $this->selected, $this->required);
        }

        echo '<p class="remove undeleteable"><a href="javascript:void(0);"><i class="fa fa-fw fa-times"></i></a></p>';
        echo '</div>';
        echo '<p class="add"><a href="javascript:void(0)"><i class="fa fa-fw fa-plus"></i>Add more</a></p>';
        echo '</div>';
        echo '</div>';
    }

    private function printDropdown($options, $id, $name, $selected = false, $required = false, $hidden = false) {
        echo '<select autocomplete="off" ' . $this->getRequiredInputHtml() . ' name="' . $name . '" id="' . $id . '">';

        // If the dropdown is required add a first option without a value
        if($required) {
            $options = array('Select an option' => '') + $options;
        }
        // Print all values as an option
        foreach($options as $option => $label) {
            if($selected && $selected == $option) {
                $selectedHtml = 'selected="selected"';
            }
            else {
                $selectedHtml = '';
            }
            echo '<option value="' . $option . '" ' . $selectedHtml . '>' . $label . '</option>';
        }
        echo '</select>';
    }

    private function hasMultipleOptions($array) {
        return is_array(reset($array));
    }
} 