<?php

$slides = SlideGenerator::getInstance()->getSlidesFromDb($this->module->getCleanRecords());
foreach($slides as $slide) {
    echo $slide->getHtml();
}
//var_dump($slides);