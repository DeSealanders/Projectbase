<?php
// Load default config
require('php/config/conf.default.php');
DefaultConfig::getInstance()->init();
?>
<!DOCTYPE html>
<html>
<head>
<?php
// Print all css and js includes
IncludeLoader::getInstance()->printIncludes();

// Print analytics tracking code
AnalyticsLoader::getInstance()->printTrackingCode();
?>
</head>
<body>

<p>
    Todo features:
    <ol>
    <li><strike>Config file for includes (css/js)</strike></li>
    <li><strike>Auto include config files</strike></li>
    <li><strike>Php css files</strike></li>
    <li><strike>Class documentation</strike></li>
    <li><strike>Default htaccess options (404 etc)</strike></li>
    <li><strike>Improved logger</strike></li>
    <li><strike>Standaard libraries/fonts</strike></li>
    <li><strike>Modules</strike></li>
    <li><strike>Visitor tracking</strike></li>
    <li><strike>Formbuilder basiselementen</strike></li>
    <li><strike>Formbuilder uitbreiden met meer elementen</strike></li>
    <li>Formbulider fileupload</li>
    <li>Formbulider config</li>
    <li>Formbuilder ajax submit</li>
    <li>Formbulider validatie</li>
    <li>Dataprovider</li>
    <li>Frontend helpers (image, menu, footer etc)</li>
    <li>Querybuilder</li>
    <li>Better database debugging</li>
    <li>Abstract classes (factory & manager)</li>
    <li>Phpstorm template comments</li>
    <li>Improved get parameters</li>
    <li>Javascript default functions/setups</li>
    <li>Content pages?</li>
    </ol>
</p>
</body>
</html>
<?php
// Display logged messages (only on dev)
if(!isLive()) {
    echo Logger::getInstance()->printMessages();
}
?>