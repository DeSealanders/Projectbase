<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
    <title>Impressentation</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="image/favicon.png" type="image/x-icon">

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:regular,semibold,italic,italicsemibold|PT+Sans:400,700,400italic,700italic|PT+Serif:400,700,400italic,700italic" rel="stylesheet" />
    <link href="css/impress-demo.css" rel="stylesheet" />
    <?php

    // Print all css and js includes
    IncludeLoader::getInstance()->printIncludes();

    // Print analytics tracking code
    AnalyticsLoader::getInstance()->printTrackingCode();
    ?>
</head>
<body class="impress-not-supported">

    <div class="fallback-message">
        <p>Your browser <b>doesn't support the features required</b> by impress.js, so you are presented with a simplified version of this presentation.</p>
        <p>For the best experience please use the latest <b>Chrome</b>, <b>Safari</b> or <b>Firefox</b> browser.</p>
    </div>

    <div id="impress">

        <?php

        // Render projects list
        ModuleManager::getInstance()->loadModule('Slides');
        $slideModule = ModuleManager::getInstance()->getModule('Slides');
        $slideModule->printFrontendHtml('multi');

        ?>

    </div>
    <script src="js/impress.js"></script>
    <script>
        var api = impress();
        api.init();
    </script>
</body>