<?php
$record = $this->module->getRecord($itemid);
if(isset($record['slides'])) {
    $query = new Query();
    $query->select('*');
    $query->from('module_slides');
    $idlist = ('"' . implode('","', explode(',',$record['slides'])). '"');
    $query->where('itemid IN (' .  $idlist . ')');
    $dbSlides =  DatabaseManager::getInstance()->executeQuery($query);
    $slides = SlideGenerator::getInstance()->convertDbtoSlides($dbSlides);
    foreach($slides as $slide) {
        //var_dump($slide);
        echo $slide->getHtml();
    }
}