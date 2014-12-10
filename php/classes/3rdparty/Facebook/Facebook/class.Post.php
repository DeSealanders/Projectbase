<?php
/**
 * Class Post
 * This class represents a single post to facebook
 * It holds information like the message, a link etc
 */
class Post {

    private $message;
    private $link;
    private $image;
    private $name;
    private $caption;
    private $description;

    public function __construct($message, $link, $image = false, $name, $caption, $description) {
        $this->message = $message;
        $this->link = $link;
        $this->image = $image;
        $this->name = $name;
        $this->caption = $caption;
        $this->description = $description;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getLink() {
        return $this->link;
    }

    public function getImage() {
        return $this->image;
    }

    public function getCaption()
    {
        return $this->caption;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getName()
    {
        return $this->name;
    }

} 