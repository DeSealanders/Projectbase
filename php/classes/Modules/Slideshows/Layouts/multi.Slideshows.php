<?php

$records = $this->getRecords();
if(!empty($records)) {
    echo '<div class="slideshows">';
    foreach($records as $record) {
        echo '<a class="block" href="slides?show=' . $record['itemid'] . '">';
        echo '<h1>' . $record['title'] . '</h1>';
        if(isset($record['image'])) {
            echo '<img src="' . $record['image'] . '">';
        }
        if(isset($record['description'])) {
            echo '<div class="desc">' . strip_tags(html_entity_decode($record['description'])) . '</div>';
        }
        echo '</a>';
    }
    echo '<a class="link" href="module/">Voeg zelf een slideshow toe!</a>';
    echo '</div>';
}