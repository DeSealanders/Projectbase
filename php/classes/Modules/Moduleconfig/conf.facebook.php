<?php
/**
 * Class FacebookConfig
 * This class holds the configuration for the FacebookManager
 */
class FacebookConfig {

    private $config;

    public function __construct() {
        /*
         * --- Configuration options here ---
         */

        $this->config = array(
            'configId' => 'facebook', // used for identifying multiple accounts
            'appId' => 'xxx',
            'app_secret' => 'xxx',
            'access_token' => 'xxx',
            'pageId' => 'xxx'
        );

        /*
         * --- End of configuration options ---
         */
    }

    public function getConfig() {
        return $this->config;
    }

} 