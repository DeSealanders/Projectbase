<?php

class ImportManager {

    private $regions;

    private function __construct() {
        $this->regions = array(
            'na',
            'euw'
        );
    }

    /**
     * Function for creating only 1 instance and return that each time its called (singleton)
     * @return DatabaseManager
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new ImportManager();
        }
        return $instance;
    }

    public function getImport() {
        return $this->import();
    }

    private function import() {
        $imports = array();
        foreach($this->regions as $region) {
            $imports[] = new Import($region);
        }
        return $imports;
    }

} 