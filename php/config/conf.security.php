<?php
/**
 * Class SecurityConfig
 * This class is repsonsible for setting up the correct security settings
 */
class SecurityConfig extends Singleton {

    protected function __construct() {
        /*
         * --- Configuration options here ---
         */

        $this->securePages = array(
            'module',
            'todo'
        );

        /*
         * --- End of configuration options ---
         */
    }

    public function getSecurePages() {
        return $this->securePages;
    }
}



?>