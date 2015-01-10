<?php

/**
 * Class Groupbox
 * This class represents an groupbox which can be filled with formcomponents
 */
class Groupbox extends FormComponent{

    private $components;
    private $startHtml;
    private $endHtml;

    public function __construct($label, $id, $startHtml = '', $endHtml = '', $components = false) {
        parent::__construct($id, $label, false);
        $this->startHtml = $startHtml;
        $this->endHtml = $endHtml;
        $this->components = array();
        if($components) {
            if(is_array($components)) {
                foreach($components as $component) {
                    $this->components[$component->getId()] = $component;
                }
            }
            else {
                $this->components[$components->getId()] = $components;
            }
        }
    }

    public function printHtml() {
        echo '<div class="component groupbox">';
        echo $this->startHtml;
        foreach($this->components as $component) {
            $component->printHtml();
        }
        echo $this->endHtml;
        echo '</div>';
    }

    public function addComponent($component) {
        $this->components[$component->getId()] = $component;
    }
} 