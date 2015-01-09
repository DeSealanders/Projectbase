<?php

class Slide {

    private $title;
    private $content;
    private $xPos;
    private $yPos;

    public function __construct($slideData) {
        $this->title = $this->getSlideData('title', $slideData);
        $this->content = $this->getSlideData('content', $slideData);
        $this->xPos = $this->getSlideData('xpos', $slideData);
        $this->yPos = $this->getSlideData('ypos', $slideData);
    }

    private function getSlideData($dbField, $slide) {
        if(isset($slide[$dbField])) {
            return $slide[$dbField];
        }
        else {
            return false;
        }
    }

    public function getHtml() {
        $html = '<div id="' . $this->title . '" class="step slide" data-x="' . $this->xPos . '" data-y="' . $this->yPos . '">';
        $html .= '<q>' . $this->content . '</q>';
        $html .= '</div>';
        return $html;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setXPos($xPos)
    {
        $this->xPos = $xPos;
    }

    public function getXPos()
    {
        return $this->xPos;
    }

    public function setYPos($yPos)
    {
        $this->yPos = $yPos;
    }

    public function getYPos()
    {
        return $this->yPos;
    }

} 