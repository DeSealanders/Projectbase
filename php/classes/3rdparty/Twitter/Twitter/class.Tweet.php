<?php
/**
 * Class Tweet
 * This class represents a tweet
 * It is responsible for formatting the correct message
 * It will also add a link if specified
 * If a tweet is more than 140 characters, it will be split into multiple tweets
 */

class Tweet {

    private $message;
    private $link;
    private $urlLength;

    public function __construct($message, $link = false, $urlLength = 22) {
        $this->message = $message;
        $this->link = $link;
        $this->urlLength = $urlLength;
    }

    /**
     * Retrieve a tweetable message
     * @return array|mixed|string a tweetable message or array of tweetable messages (depending on length)
     */
    public function getTweet() {
        return $this->buildTweet();
    }

    /**
     * This function builds a tweet by adding a link if specified and splitting up the tweet into an array if needed
     * @return array|mixed|string a tweetable message or array of tweetable messages (depending on length)
     */
    private function buildTweet() {
        if($this->link) {

            // Create a string like http://t.co/aaaaaa to be replaced later on
            // This simulates the length of an shorted twitter url e.g. http://t.co/2Tuwdznj26
            // The length of this simulated link is specified by urlLength, which is loaded from twitter
            $linkbase = 'http://t.co/';
            $linkReplacement = $linkbase . str_repeat('a', ($this->urlLength-strlen($linkbase)));
            $tweet = $this->message;
            $tweet .= ' ' . $linkReplacement;
        }
        else {
            $tweet = $this->message;
        }

        // Split into multiple tweets when too long for one
        if(strlen($tweet) >= 140) {
            $tweet = $this->splitTweet($tweet);
        }

        if($this->link) {

            // Replace the simulated link with the actual link
            $tweet = str_replace($linkReplacement, $this->link, $tweet);
        }
        return $tweet;
    }

    /**
     * This function splits up a tweet into chucks of 140 characters or less
     * It also adds a counter e.g. (1/2)
     * @param $tweet a tweet which needs to be split up
     * @return array|string a list of tweets which are split up
     */
    private function splitTweet($tweet) {

        // Split the string into 130 characters or less chucks
        $tweets = wordwrap($tweet, 130, "|", true);
        $tweets = explode('|', $tweets);

        foreach($tweets as $count => &$tweet) {

            // Add three dots to tweets which will be followed up
            if(($count+1) != count($tweets)) {
                $tweets[$count] = $tweet = $tweet . '...';
            }

            // Add (1/2) etc to each tweet
            $tweets[$count] = $tweet = $tweet . ' (' . ($count+1) . '/' . count($tweets) . ')';

            // Report an error when something went wrong
            if(strlen($tweet) > 140) {
                Logger::getInstance()->log('Tweet: tweet too long after splitting');
            }
        }
        return $tweets;
    }

} 