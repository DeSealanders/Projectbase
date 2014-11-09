<?php


use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookRequestException;

/**
 * Class FacebookManager
 * This class is used for posting messages to facebook
 */
class FacebookManager {

    private $hasConfig;
    private $session;

    /**
     * Load the config from conf.facebook.php
     */
    private function __construct() {
        $this->hacConfig = false;
        $config = new FacebookConfig();
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
            $instance = new FacebookManager();
        }
        return $instance;
    }

    /**
     * Setup the correct variables from a config
     * @param $config a list of variables required to post on facebook
     */
    public function loadConfig($config) {
        FacebookSession::setDefaultApplication(
            $config['appId'],
            $config['app_secret']
        );
        $this->pageId = $config['pageId'];
        $this->session = new FacebookSession($config['access_token']);
        $this->hasConfig = true;

    }

    /**
     * Post a message to facebook
     * @param $message the message itself
     * @param string $link a link attached to the message
     * @param bool $image an image (not implementend)
     * @param string $name title of the link box
     * @param string $caption subscript of the link box
     * @param string $description regular text within the link box
     */
    public function post($message, $link = '', $image = false, $name = '', $caption = '', $description = '') {
        if($this->hasConfig) {
            $post = new Post($message, $link, $image, $name, $caption, $description);
            if($this->session) {
                if(isLive()) {
                    try {
                        $request = (new FacebookRequest(
                            $this->session, 'POST', '/' . $this->pageId . '/feed', array(
                                'message'       => $post->getMessage(),
                                'link'          => $post->getLink(),
                                'name'          => $post->getName(),
                                'caption'       => $post->getCaption(),
                                'description'   => $post->getDescription()
                            )
                        ));
                        $executed = $request->execute();
                        $response = $executed->getGraphObject();
                        Logger::getInstance()->writeMessage('Posted succesfully with id: ' . $response->getProperty('id'));
                    } catch(FacebookRequestException $e) {
                        Logger::getInstance()->writeMessage('Error while facebook posting: ' . $e->getMessage());
                    }
                }
                else {
                    Logger::getInstance()->writeMessage('Not live, so not sending post: ' . $post->getMessage());
                }
            }
        }
        else {
            Logger::getInstance()->writeMessage('No facebook config loaded');
        }
    }

    /**
     * Returns wether or not a config has been set
     * @return mixed true if a config is set, false otherwise
     */
    public function hasConfig() {
        return $this->hasConfig;
    }

} 