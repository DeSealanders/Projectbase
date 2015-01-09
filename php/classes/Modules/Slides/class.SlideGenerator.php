<?php

class SlideGenerator extends Singleton {

    public function __construct() {

    }

    public function getSlidesFromDb($slides) {
        $slidelist = array();
        if($slides) {
            foreach($slides as $slide) {
                $slidelist[] = new Slide($slide);
            }
        }
        return $slidelist;
    }

} 