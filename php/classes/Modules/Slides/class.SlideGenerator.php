<?php

class SlideGenerator extends Singleton {

    public function __construct() {

    }

    public function convertDbtoSlides($slides) {
        $slidelist = array();
        if($slides) {
            foreach($slides as $slide) {
                $slidelist[] = new Slide($slide);
            }
        }
        return $slidelist;
    }

} 