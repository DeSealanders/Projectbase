<?php

class Slide {

    private $title;
    private $content;
    private $options;

    public function __construct($slideData) {
        $this->title = $this->getSlideData('title', $slideData);
        $this->content = html_entity_decode($this->getSlideData('content', $slideData));
        $this->options = array(
                    'data-scale' => $this->getSlideData('size', $slideData),
                    'data-x' => $this->getSlideData('xpos', $slideData),
                    'data-y' => $this->getSlideData('ypos', $slideData),
                    'data-z' => $this->getSlideData('zpos', $slideData),
                    'data-rotate-x' => $this->getSlideData('xrot', $slideData),
                    'data-rotate-y' => $this->getSlideData('yrot', $slideData),
                    'data-rotate-z' => $this->getSlideData('zrot', $slideData),
        );
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
        $html = '<div id="' . $this->cleanString($this->title) . '" class="step slide"';
        foreach($this->options as $option => $value) {
            if(isset($value) && !empty($value)) {
                $html .= ' ' . $option . '="' . $value . '"';
            }
        }
        $html .= '>';
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

    private function cleanString($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

} 