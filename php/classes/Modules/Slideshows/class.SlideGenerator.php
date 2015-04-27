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
        $slidelist[] = new Slide(
            array(
                'title' => 'Naar overzicht',
                'content' => '<a href="/"><i class="fa fa-link"></i> Klik <b>hier</b> om terug naar het overzicht te gaan</a>',
                'zpos' => -20000,
            )
        );
        return $slidelist;
    }

} 