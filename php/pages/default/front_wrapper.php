<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
    <title>Impressentation</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="image/favicon.png" type="image/x-icon">
    <?php

    // Print all css and js includes
    IncludeLoader::getInstance()->printIncludes();

    // Print analytics tracking code
    AnalyticsLoader::getInstance()->printTrackingCode();
    ?>
</head>
<body>
<?php

/* This page is loaded by the Router by default
 * It can be used to generate a general template
 * The actual requested page is stored in $_SERVER['ROUTE']
 * Requiring it will load the request page within this page
 */
require($_SERVER['ROUTE']);

?>
</body>
</html>