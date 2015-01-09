<?php
/**
 * Class ModulesConfig
 * This class is repsonsible for activating modules
 */
class ModulesConfig extends Singleton {

    private $moduleNames;

    protected function __construct() {
        /*
         * --- Configuration options here ---
         */

        $this->moduleNames = array(
            'Slides',
            'Colors',
        );

        /*
         * --- End of configuration options ---
         */
    }

    public function getModuleNames() {
        return array_map('strtolower', $this->moduleNames);
    }
}



?>