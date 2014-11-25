<?php
/**
 * Class FormConfig
 * This class is repsonsible for all form-related settings
 */
class FormConfig {

    private $useAjax;

    public function __construct() {
        /*
         * --- Configuration options here ---
         */

        $this->useAjax = true;
        // TODO possible options:
        // Save results to database
        // E-mail form results
        // Configure e-mail adres
        // E-mail copy

        /*
         * --- End of configuration options ---
         */
    }

    /**
     * Function for creating only 1 instance and return that each time its called (singleton)
     * @return FormConfig
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new FormConfig();
        }
        return $instance;
    }

    public function useAjax() {
        return $this->useAjax;
    }
}



?>