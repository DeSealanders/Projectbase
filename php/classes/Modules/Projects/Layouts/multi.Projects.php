<?php
if($projects = $this->module->getCleanRecords()) {
    foreach($projects as $project) {
        echo '<h2>' . $project['name'] . '</h2>';
        echo '<p>' . $project['description'] . '</p><br>';
        echo '<table>';
        echo '<tr><td><strong>Categorie</strong></td><td>' . $project['category'] . '</td></tr>';
        echo '<tr><td><strong>Status</strong></td><td>' . $project['status'] . '</td></tr>';
        echo '<tr><td><strong>Tags</strong></td><td>' . $project['tags'] . '</td></tr>';
        echo '</table>';
    }
}