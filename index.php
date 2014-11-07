<?php
require('php/config/conf.default.php');
$defaultConfig = new DefaultConfig();
$defaultConfig->setAutoInclude(true);
?>
<!DOCTYPE html>
<html>
<head>
<?php IncludeLoader::getInstance()->printIncludes(); ?>
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
    <li>Php css files</li>
    <li>Abstract classes (factory & manaager)</li>
    <li>Default htaccess options (404 etc)</li>
    <li>Formbuilder</li>
    <li>Better database debugging</li>
    <li>Improved logger</li>
    <li>Phpstorm template comments</li>
    <li>Improved get parameters</li>
    <li>Class documentation</li>
    <li>Content pages?</li>
    </ol>
</p>
</body>
</html>