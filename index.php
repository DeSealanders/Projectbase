<?php
// Load default config
require('php/config/conf.default.php');
$defaultConfig = new DefaultConfig();
?>
<!DOCTYPE html>
<html>
<head>
<?php
// Print all css and js includes
IncludeLoader::getInstance()->printIncludes();
?>
</head>
<body>
<?php
$db = DatabaseManager::getInstance();
?>
<p>
    Todo features:
    <ol>
    <li><strike>Config file for inclues (css/js)</strike></li>
    <li><strike>Auto include config files</strike></li>
    <li><strike>Php css files</strike></li>
    <li><strike>Class documentation</strike></li>
    <li><strike>Default htaccess options (404 etc)</strike></li>
    <li>Abstract classes (factory & manager)</li>
    <li>Formbuilder</li>
    <li>Better database debugging</li>
    <li>Improved logger</li>
    <li>Phpstorm template comments</li>
    <li>Improved get parameters</li>
    <li>Javascript default functions/setups</li>
    <li>Content pages?</li>
    <li>Visitor tracking</li>
    <li>Dataprovider</li>
    </ol>
</p>
</body>
</html>