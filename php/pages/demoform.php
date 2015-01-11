<div class="testformulier">
<?php
var_dump($_POST);
$form = new Form('Testformulier', 'testform');
$form->addComponent(new Textfield('Voornaam', 'firstname', 'Peter'));
$form->addComponent(new Textfield('Achternaam', 'lastname', 'Ton'));
$form->addComponent(new Emailfield('E-mail adres', 'email', 'mail@peterton.nl'));
$form->addComponent(new Textbox('Bericht', 'message', 'Type hier uw bericht', ''));
/*$form->addComponent(new MultiDropdown('Contentblok', 'content', array(
        'test1',
        'test2',
    )));*/
$group = new Groupbox('Nummertjes', 'numbers', '<h1>Nummertjes</h1><p>hier komen nummertjes</p>', '<p>hier stoppen nummertjes</p>');
$group->addComponent(new Numberslider('Getal', 'nr', 0, 360, 45));
$group->addComponent(new Numberbox('Getal2', 'nr2', '', '', 100));
$form->addComponent($group);
$form->addComponent(new MultiDropdown('Contentblok', 'content',
    array(
        2 => array(
            'Projects' =>
                array(
                    'project1',
                    'project2',
                    'project3'
                )
        ),
        1 => array(
            'Contact' =>
                array(
                    4 => 'Peter',
                    6 => 'Jordi'
                )
        ),
        3 => array(
            'Content' =>
                array(
                    'Wie',
                    'Wat',
                    'Levering'
                )
        )
    )
));
$form->addComponent(new MultiDropdown('Projecten', 'pro',
    array(
        2 => array(
            'Construction' =>
                array(
                    'Creation',
                    'Adaption',
                    'Destruction'
                )
        ),
        1 => array(
            'Aquamanagement' =>
                array(
                    4 => 'River',
                    6 => 'Pool'
                )
        )
    )
));


$form->addComponent(new CustomHtml('subtitle', '<h3>Persoonlijke voorkeuren</h3>'));
$form->addComponent(new Checkbox('Favoriete drank', 'drinks', array(
        'cola' => 'Cola',
        'beer' => 'Bier',
        'coffee' => 'Koffie'
    ), true));
$form->addComponent(new Radiobutton('Geslacht', 'gender', array(
        'male' => 'Man',
        'female' => 'Vrouw',
    ), true));
$form->addComponent(new Dropdown('Automerk', 'brand', array(
        'vw' => 'Volkswagen',
        'seat' => 'Seat',
        'audi' => 'Audi'
    )));
$form->addComponent(new ButtonGroup('Buttons', array(
        new Button('Test1', 'test1'),
        new Button('Test2', 'test2'),
        new Button('Test3', 'test3'),
    )));
$form->addComponent(new Colorpicker('Kleur', 'color', '2c3e50'));
$form->addComponent(new Texteditor('Html', 'html', '', 'test'));
$form->addComponent(new Button('Versturen', 'send'));
$form->printHtml();
?>
