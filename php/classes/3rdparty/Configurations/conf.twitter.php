<?php
/**
 * Class TwitterConfig
 * This class holds the configuration for the TweetManager
 */
class TwitterConfig {

    private $config;

    public function __construct() {
        /*
         * --- Configuration options here ---
         */

        $this->config = array(
            'configId' => 'twitter', // used for identifying multiple accounts
            'consumerKey' => 'xxx',
            'consumerSecret' => 'xxx',
            'accessToken' => 'xxx',
            'accessTokenSecret' => 'xxx',
            'screenName' => 'xxx'
        );

        /*
         * --- End of configuration options ---
         */
    }

    public function getConfig() {
        return $this->config;
    }

} 