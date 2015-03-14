<?php

$records = $this->getRecords();
foreach($records as $record) {
    echo '<div class="block">';
    echo '<h1>' . $record['title'] . '</h1>';
    echo '<a href="impressentation/slides?show=' . $record['itemid'] . '">Link</a>';
    echo '</div>';
}