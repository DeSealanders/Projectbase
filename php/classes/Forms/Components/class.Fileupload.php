<?php

/**
 * Class Fileupload
 * This class represents a Fileupload in a generated form
 */
class Fileupload extends FormComponent{

    private $value;

    public function __construct($label, $id, $value = '', $required = false) {
        parent::__construct($id, $label, $required);
        $this->value = $value;
    }

    public function printHtml() {
        echo '<div class="component fileupload">';
        echo '<label for="'. $this->id . '">' . $this->label . $this->getRequiredLabelHtml() . '</label>';
        echo '<div class="inputwrapper">';
        echo '<input  ' . $this->getRequiredInputHtml() . ' name="' . $this->id . '" id="' . $this->id . '" value="' . $this->value. '" type="file"></input>';
        if($this->value) {
            $img = ImageResizer::getInstance()->resizeImage($this->value, 150, 150);
            echo '<p>Current file:</p>';
            if($img) {
                echo '<img src="../../' . $img->getFullFilepath() . '">';
            }
            else {
                echo '<p>No preview available</p>';
            }
            echo '<input type="hidden" name="' . $this->id . '" value="' . $this->value. '">';
            echo '<p><input type="checkbox" name="' . $this->id . '" value="">Delete file</p>';
        }
        echo '</div>';
        echo '</div>';
    }
} 