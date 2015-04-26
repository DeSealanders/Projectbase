<?php

$records = $this->getRecords();
foreach($records as $record) {
    echo '<div class="block">';
    if(isset($record['image'])) {
        echo '<img src="' . $record['image'] . '">';
    }
    echo '<h1>' . $record['title'] . '</h1>';
    echo '<a href="slides?show=' . $record['itemid'] . '">Link</a>';
    echo '</div>';
}