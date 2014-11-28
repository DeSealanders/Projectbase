<div class="testformulier">
<?php
var_dump($_POST);
$form = new Form('Testformulier', 'testform');
$form->addComponent(new Textfield('Voornaam', 'firstname', 'Peter', ''));
$form->addComponent(new Textfield('Achternaam', 'lastname', 'Ton', '', true));
$form->addComponent(new Emailfield('E-mail adres', 'email', 'mail@peterton.nl', '', true));
$form->addComponent(new Textbox('Bericht', 'message', 'Type hier uw bericht', ''));
$form->addComponent(new CustomHtml('subtitle', '<h3>Persoonlijke voorkeuren</h3>'));
$form->addComponent(new Checkbox('Favoriete drank', 'drinks', array(
        'Cola' => 'cola',
        'Bier' => 'beer',
        'Koffie' => 'coffee'
    ), true));
$form->addComponent(new Radiobutton('Geslacht', 'gender', array(
        'Man' => 'male',
        'Vrouw' => 'female',
    ), true));
$form->addComponent(new Dropdown('Automerk', 'brand', array(
        'Volkswagen' => 'vw',
        'Seat' => 'seat',
        'Audi' => 'audi'
    )));
$form->addComponent(new Button('Versturen', 'send'));
$form->printHtml();
?>
</div>