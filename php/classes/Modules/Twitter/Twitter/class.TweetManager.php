<?php
/**
 * Class TweetManager
 * This class is responsible for sending out tweets to a specified twitter account
 * The account is set in /Modules/Moduleconfig/conf.twitter.php, which needs to be set before sending tweets
 */

class TweetManager {

    private $hasConfig;
    private $urlLength;

    private function __construct() {
        $this->hasConfig = false;
        $this->urlLength;
        $this->twitter = \Codebird\Codebird::getInstance();
        $config = new TwitterConfig();
        $this->loadConfig($config->getConfig());
    }

    /**
     * Function for creating only 1 instance and return that each time its called (singleton)
     * @return TweetManager
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new TweetManager();
        }
        return $instance;
    }

    /**
     * Load a twitter account config
     * @param $config an array containing a consumerKey, a consumerSecret, an accessToken and an accessTokenSecret
     */
    public function loadConfig($config){
        $consumerKey = $config['consumerKey'];
        $consumerSecret = $config['consumerSecret'];
        $accessToken = $config['accessToken'];
        $accessTokenSecret = $config['accessTokenSecret'];

        // Setup codebird with specified config
        Codebird\Codebird::setConsumerKey($consumerKey, $consumerSecret);
        $this->twitter->setToken($accessToken, $accessTokenSecret);

        // Query for the urlLength
        $this->loadUrlLength();

        // Config is loaded
        $this->hasConfig = true;
    }

    /**
     * Send a tweet with a specified message and an optional link
     * @param $message the message to be tweeted
     * @param $link a link which will be attached to the tweet
     * @throws Exception an exception will be thrown when no config has been loaded
     */
    public function tweet($message, $link = false) {
        if($this->hasConfig) {
            $tweet = new Tweet($message, $link, $this->urlLength);
            if(is_array($tweet->getTweet())) {

                // Send multiple tweets in reverse so they show up correctly on timelines
                foreach(array_reverse($tweet->getTweet()) as $tweet) {
                    $this->sendTweet($tweet);
                }
            }
            else {
                $this->sendTweet($tweet->getTweet());
            }
        }
        else {
            Throw new Exception('No twitter config loaded');
        }
    }

    /**
     * Returns wether or not a config has been set
     * @return mixed true if a config is set, false otherwise
     */
    public function hasConfig() {
        return $this->hasConfig;
    }

    /**
     * Post a status update with a specified tweet
     * @param $tweet the tweet which needs to be send
     * @return bool returns true if successfull, false otherwise
     */
    private function sendTweet($tweet) {
        $params = array(
            'status' => $tweet
        );
        if(isLive()) {
            $reply = $this->twitter->statuses_update($params);
            Logger::getInstance()->writeMessage('Sent a tweet: ' . $tweet);
            if(isset($reply->errors)) {
                foreach($reply->errors as $error) {
                    Logger::getInstance()->writeMessage('Error while tweeting: ' . $error->message);
                }
                return false;
            }
        }
        else {
            echo Logger::getInstance()->writeMessage('Not live, so not sending tweet: ' . $tweet);
        }
        return true;
    }

    /**
     * Query twitter for the specified urllength of shortend urls
     */
    private function loadUrlLength() {
        $config = $this->twitter->help_configuration();
        if(isset($config->short_url_length)) {
            $this->urlLength = $config->short_url_length;
        }
        else {
            $this->urlLength = 22;
        }
    }



} 