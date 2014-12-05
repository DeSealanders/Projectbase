<?php
/**
 * Class FormConfig
 * This class is repsonsible for all form-related settings
 */
class FormConfig extends Singleton {

    private $useAjax;

    protected function __construct() {
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

    public function useAjax() {
        return $this->useAjax;
    }
}



?>