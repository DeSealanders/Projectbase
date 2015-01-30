<?php

class CheckboxComponent extends ModuleComponent {

    private $options;

    public function __construct($label, $id = false, $options, $showInMulti = true) {
        parent::__construct($label, $id, $showInMulti);
        $this->options = $options;
    }

    public function getFormComponent($value) {
        return new Checkbox($this->label, $this->id, $this->options, $value);
    }

    public function getPreview($value) {
        $options = array();
        foreach(explode(',', $value) as $value) {
            if(isset($this->options[$value])) {
                $options[] = $this->options[$value];
            }
        }
        if(!empty($options)) {
            return implode(', ', $options);
        }
        else {
            return $value;
        }
    }

    public function getOptions() {
        return $this->options;
    }

    /**
     * Fix post data for checkboxes (since they are posted seperately)
     * @param $data
     * @return string
     */
    public function saveData($data) {
        return implode(',', $data);
    }
} 