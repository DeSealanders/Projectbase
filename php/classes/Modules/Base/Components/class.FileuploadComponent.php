<?php

class FileuploadComponent extends ModuleComponent {

    private $allowedTypes;
    private $uploadDir;

    public function __construct($label, $id = false, $showInMulti = true) {
        parent::__construct($label, $id, $showInMulti);
        $this->allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        $this->uploadDir = 'image/uploads/';
    }

    public function getFormComponent($value) {
        return new Fileupload($this->label, $this->id, $value);
    }

    public function saveData($data) {
        if(is_array($data)) {
            if(isset($data['error']) && $data['error'] == 0) {
               if(isset($data['tmp_name']) && isset($data['name'])) {
                   $tmpFile = $data['tmp_name'];
                   $fileName = $data['name'];
                   if(is_file($tmpFile)) {
                        if(getimagesize($tmpFile) !== false) {
                           $extension = pathinfo($fileName,PATHINFO_EXTENSION);
                            if(in_array($extension, $this->allowedTypes)) {
                                $target = $this->uploadDir . basename($fileName);
                                if ($uploaded = move_uploaded_file($tmpFile, $target)) {
                                    return $target;
                                }
                            }
                       }
                   }
               }


            }
            Logger::getInstance()->writeMessage('Unable to upload file');
        }
        else {
            return $data;
        }
    }

    public function getPreview($filePath) {
        return $filePath;
    }
} 