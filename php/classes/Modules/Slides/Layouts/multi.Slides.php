<?php

$slides = SlideGenerator::getInstance()->convertDbtoSlides($this->module->getCleanRecords());
foreach($slides as $slide) {
    echo $slide->getHtml();
}
//var_dump($slides);