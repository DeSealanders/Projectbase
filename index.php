<?php
require('php/config/conf.default.php');
?>
<!DOCTYPE html>
<html>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/default.css">
    <script src="js/documentready.js"></script>
</head>
<body>
<?php
$test = new Test();
$test->helloWorld();
$db = DatabaseManager::getInstance();
?>
</body>
</html>