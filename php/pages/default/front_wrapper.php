<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
    <title>Projectbase</title>
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
<div class="content">
    <?php

    if($_SERVER['ROUTE'] != 'php/pages/default/login.php') {
    ?>
    <span class="user">
        <?php
        if($user = UserManager::getInstance()->getCurrentUser()) {
            echo '<span class="fa fa-fw fa-user"></span><span>' .  ucfirst($user->getUsername()) . '</span><span> <a href="logout">(Logout)</a></span>';
        }
        else {
            echo '<span><a href="login">Login</a></span>';
        }
        ?>
    </span>
    <?php
    }

    /* This page is loaded by the Router by default
     * It can be used to generate a general template
     * The actual requested page is stored in $_SERVER['ROUTE']
     * Requiring it will load the request page within this page
     */
    require($_SERVER['ROUTE']);

    ?>
</div>
</body>
</html>