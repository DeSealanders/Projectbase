<?php
header('Content-Type: application/json');
$records = $this->getRecords();
echo json_encode($records);