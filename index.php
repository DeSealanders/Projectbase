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
<div class="testformulier">
<?php
$form = new Form('Testformulier', 'testform');
$form->addComponent(new Textfield('Voornaam', 'firstname', 'Peter'));
$form->addComponent(new Textfield('Achternaam', 'lastname', 'Ton'));
$form->addComponent(new Emailfield('E-mail adres', 'email', 'mail@peterton.nl'));
$form->addComponent(new Checkbox('Favoriete drank', 'drinks', array(
        'Cola' => 'cola',
        'Bier' => 'beer',
        'Koffie' => 'coffee'
    )));
$form->addComponent(new Textbox('Bericht', 'message', 'Type hier uw bericht'));
$form->addComponent(new Button('Versturen', 'send'));
$form->printHtml();
?>
</div>

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
    <li>Formbuilder uitbreiden</li>
    <li>Dataprovider</li>
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
if(!isLive()) {
    echo Logger::getInstance()->printMessages();
}
?>