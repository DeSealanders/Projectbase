<?php

class Form {

    private $name;
    private $id;
    private $components;
    private $errors;
    private $htmlMail;

    public function __construct($name, $id) {
        $this->name = $name;
        $this->id = $id;
        $this->components = array();
        $this->errors = array();
        $this->htmlMail = false;
    }

    public function printHtml() {
        echo '<form method="POST" enctype="multipart/form-data" class="customForm" id="' . $this->id . '">';
        echo '<h2>' . $this->name . '</h2>';

        // Show any errors
        if(!empty($this->errors)) {
            if(count($this->errors) > 1) {
                $msg = 'Vul alstublieft de volgende velden in:';
            }
            else {
                $msg = 'Vul alstublieft het volgende veld in:';
            }
            echo '<p class="error">' . $msg . ' ' . implode(',', $this->errors) . '</p>';
        }

        $required = false;

        // Print html for each individual form component
        foreach($this->components as $component) {
            if($component->isRequired()) {
                $required = true;
            }
            $component->printHtml();
        }

        // Display required explaination if one or more required fields are present
        if($required) {
            echo '<p><span class="required">*</span> = verplicht </p>';
            echo '</form>';
        }

    }

    public function addComponent($component) {

        // Check if the given id is not already used for another component
        if(!array_key_exists($component->getId(), $this->components)) {
            $this->components[$component->getId()] = $component;
        }
        else {
            Logger::getInstance()->writeMessage('Duplicate id found in form: ' . $this->id);
        }
    }

    public function handle() {

        // Show form when no data has been posted
        if(empty($_POST)) {
            $this->printHtml();
            return;
        }

        // Check posted data for errors
        $this->errors = $this->checkRequiredFields($_POST);
        if(!empty($this->errors)) {
            $this->printHtml();
            return;
        }

        // See if mailing is enabled
        if($this->htmlMail) {
            // Get the form results formatted for mailing
            $results = $this->getFormresults($_POST);

            // Assign the results to the mail
            $this->htmlMail->setFields($results);

            // Send the mail
            if($this->htmlMail->mail()) {
                echo '<div id="' . $this->id . '"><p class="succes">Bedankt voor uw aanmelding.<br>U ontvangt binnenkort een bestiging van ons.</p></div>';
            }
        }
    }

    public function setMail($htmlMail) {
        $this->htmlMail = $htmlMail;
    }

    private function getFormresults($input) {
        $results = array();
        foreach($this->components as $postValue => $component) {
            if($component->isRequired()) {
                $results[$component->getLabel()] = $input[$postValue];
            }
        }
        return $results;
    }

    private function checkRequiredFields($input) {
        $errors = array();
        foreach($this->components as $postValue => $component) {
            if($component->isRequired()) {
                if(!isset($input[$postValue]) || empty($input[$postValue])) {
                    $errors[$component->getId()] = $component->getLabel();
                }
            }
        }
        return $errors;
    }

} 