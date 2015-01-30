<?php

$records = $this->getRecords();
foreach($records as $record) {
    var_dump($record);
    echo '<div class="block">';
    echo '<h1>' . $record['title'] . '</h1>';
    var_dump($record['slides']);
    echo '</div>';
}