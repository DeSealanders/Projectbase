<?php
echo '<h3>' . $this->module->getName() . '</h3>';
var_dump($this->module->getRecord($itemid));
foreach($this->getRecords() as $record) {
    echo '<br>';
    echo '<p>Naam: ' . $record['firstname'] . ' '. $record['lastname'] . '</p>';
    echo '<p>Adres: Luijksberglaan 5</p>';
    echo '<p>Telefoon: 0118-592929</p>';
    echo '<br>';
}