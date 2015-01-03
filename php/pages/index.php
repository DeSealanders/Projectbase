
<div class="center">
    <h1>Wat is dit project</h1>

    <p class="intro">
        Dit project genaamd 'Projectbase' is een verzameling van hulpmiddelen wat de basis voor een project neerlegd.
        Deze hulpmiddelen zijn bevonden als standaardfeatures voor veel projecten waardoor een algemene opzet hiervan
        veel tijd kan schelen.
        Een aantal features van dit project zullen hieronder worden besproken.
    </p>

    <h3 class="clickable">Modules</h3>
    <div class="infoblock">

        <p>
            Een van grootste en beste features is de mogelijkheid tot het maken van modules waarmee content eenvoudig
            beheerd kan worden. Een module heeft twee kanten: frontend en backend. De backend bestaat uit een
            beheeromgeving waarin bepaalde gegevens ingevoerd kunnen worden. Die gegevens kunnen dan vervolgens in de
            frontend weer gebruikt worden.
        </p>
        <p>
            Om zo'n module te maken zijn er een minimum van twee bestanden nodig: een module klasse
            waarin de verschillende componenten worden ingesteld en een layout bestand voor de frontend. Om een beter
            beeld te geven bij zo'n module klasse zal er hieronder een simpele projecten module weergegeven worden.
        </p>

        <code class="prettyprint">
class ModuleProjects extends Module {

    public function __construct() {
        parent::__construct('Projects');
        $this->setDescription('Display projects neatly sorted by category and status');
        $this->addLayout('multi');
        $this->addComponent(new TextComponent('Name', 'name'));
        $this->addComponent(new TextComponent('Description', 'description', false));
        $this->addComponent(new DropdownComponent('Category', 'category', array(
            'games' => 'Games',
            'development' => 'Development',
            'frontend' => 'Front-end'
        )));
        $this->addComponent(new RadioComponent('Status', 'status', array(
            'construction' => 'Under construction',
            'finished' => 'Finished',
        )));
    }
}
        </code>

        <p>
            Hoe dit in de beheeromgeving eruit ziet is <a target="_blank" href="module/projects/">hier</a> te zien.
        </p>



    </div>
    <h3 class="clickable">Database en SQL</h3>
    <div class="infoblock">

        <p>
            Projectbase helpt met het verbinden naar een database aan de hand van een simpel configuratiebestand.
            Daarin kunnen databasegegevens voor zowel online als lokale databases worden ingevoerd.
            Daarnaast wordt het maken en aanroepen van queries erg gemakkelijk gemaakt door het gebruik van de
            QueryBuilder en de QueryManager.
            Queries kunnen dan opgebouwd worden aan de hand van simpele php statements, zoals hieronder te zien is:
        </p>

        <code class="prettyprint">
$query = new Query();
$query->select('*');
$query->from('people as p');
$query->join('LEFT', 'emails as e', 'p.email = e.email');
echo $query;
        </code>

        <p>
            Het resultaat hiervan is de volgende SQL statement:
        </p>

        <code class="prettyprint">
<?php
$query = new Query();
$query->select('*');
$query->from('people as p');
$query->join('LEFT', 'emails as e', 'p.email = e.email');
echo $query;
?>
        </code>

    </div>
    <h3 class="clickable">Formulieren</h3>
    <div class="infoblock">
        <p>
            Er kan gemakkelijk gebruik gemaakt worden van formulieren. Deze worden met een paar simpele regels code
            opgebouwd. Hieronder is een voorbeeld te zien:
        </p>

        <code class="prettyprint">
$form = new Form('Contactfomulier', 'contactForm');
$form->addComponent(new Textfield('Voornaam', 'firstname', 'Vul hier uw voornaam in', '', true));
$form->addComponent(new Textfield('Achternaam', 'lastname', 'Vul hier uw achternaam in'));
$form->addComponent(new Emailfield('E-mail adres', 'email', 'Vul hier uw e-mailadres in', '', true));
$form->addComponent(new Textbox('Bericht', 'message', 'Type hier uw bericht', '', true));
$form->addComponent(new Button('Versturen', 'send'));
$form->printHtml();
        </code>
        <p>
            Het resultaat daarvan is het volgende formulier:
        </p>

        <p>
            <?php
            $form = new Form('Contactfomulier', 'contactForm');
            $form->addComponent(new Textfield('Voornaam', 'firstname', 'Vul hier uw voornaam in', '', true));
            $form->addComponent(new Textfield('Achternaam', 'lastname', 'Vul hier uw achternaam in'));
            $form->addComponent(new Emailfield('E-mail adres', 'email', 'Vul hier uw e-mailadres in', '', true));
            $form->addComponent(new Textbox('Bericht', 'message', 'Type hier uw bericht', '', true));
            $form->addComponent(new Button('Versturen', 'send'));
            $form->printHtml();
            ?>
        </p>

    </div>

    <h3 class="clickable">Schone urls</h3>
    <div class="infoblock">
        <p>
            Een andere functie die projectbase bezit is het routen van urls.
            Hierdoor kan een bepaalde url worden gekoppeld aan een specifiek bestand of worden
            doorgeschakeld naar een standaardlocatie.
            In het configuratiebestand van de router kan de volgende route ingesteld worden:
        </p>
        <code class="prettyprint">
$this->routes = array(
    'contact' => 'php/contact/contactformulier.php'
);
        </code>
        <p>
            Het resultaat daarvan is dat een bezoeker op de pagina www.peterton.nl/projectbase/contact het
            contactformulier voorgeschoteld krijgt.
        </p>
        <br>
        <p>
            Indien er geen koppeling is ingesteld voor een bepaalde url zal er gezocht worden naar de juiste pagina op
            een standaardlocatie. Zo zal een request naar www.peterton.nl/projectbase/about worden gekoppeld aan
            about.php in de map /php/pages/ indien die bestaat.
        </p>
    </div>

    <h3 class="clickable">Dynamisch afbeeldingen resizen</h3>
    <div class="infoblock">
        <p>
            Verder is er de mogelijkheid ingebouwd om afbeeldingen dynamisch te herschalen. Dat kan gedaan worden door
            het aanroepen van de juiste url. Daarmee wordt dan een afbeelding (indien niet aanwezig in de cache)
            herschaald en opgeslagen voor later gebruik. Zie hieronder een voorbeeld daarvan.
        </p>
        <code class="prettyprint">
            <xmp>
<img src="image/100x150/redlobster.jpg">
<img src="image/150x225/redlobster.jpg">
            </xmp>
        </code>
        <p>
            Heeft het volgende resultaat:
        </p>
            <img src="image/100x150/redlobster.jpg">
            <img src="image/150x225/redlobster.jpg">
        <p>
            Hiermee kan dus heel eenvoudig een afbeelding op een bepaald formaat in de website geladen worden.
        </p>
    </div>

    <h3 class="clickable">Google analytics</h3>
    <div class="infoblock">
        <p>
            Een ander handig hulpmiddel is de AnalyticsLoader. Deze koppelt het Google Analytics script met één simpel
            commando aan een gewenste pagina. Het enige wat daarvoor ingesteld hoeft te worden is het Analytics ID van
            Google.
        </p>
        <code class="prettyprint">
AnalyticsLoader::getInstance()->printTrackingCode();
        </code>
        <p>
            Geeft als output:
        </p>
        <code class="prettyprint"><xmp>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'testid', 'auto');
ga('send', 'pageview');
</script>
        </xmp></code>
        <p>
            Waarbij 'testid' dus vervangen zal worden door het daadwerkelijke Google Analytics ID.
        </p>
    </div>

    <h3 class="clickable">CSS en javascript inladen</h3>
    <div class="infoblock">
        <p>
            Net als de Google Analytics code kan javascript en CSS ook heel eenvoudig in een project worden geladen.
            In het configuratie bestand van de IncludeLoader kan worden gekozen uit een aantal standaard includes
            (zoals Twitter bootstrap, lightbox, jquery en font awesome). Daarnaast kunnen er zelf ook nog includes
            worden opgegeven. Die kunnen aan de hand van het volgende commando op de pagina worden weergegeven.
        </p>
        <code class="prettyprint">
IncludeLoader::getInstance()->printIncludes();
        </code>
        <p>
            Hieronder is een voorbeeld van het resultaat weergegeven
        </p>
        <code class="prettyprint"><xmp>
<link rel="stylesheet" type="text/css" href="css/lightbox.css">
<link rel="stylesheet" type="text/css" href="css/variables.php.css">
<link rel="stylesheet" type="text/css" href="css/default.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/lightbox.js"></script>
<script src="js/documentready.js"></script>
        </xmp></code>
    </div>

    <h3 class="clickable">Facebook & Twitter modules</h3>
    <div class="infoblock">
        <p>
            Verder is er ook een mogelijkheid ingebouwd om met een simpel commando te posten naar Facebook of naar
            Twitter. Dat gebeurd via de FacebookManager en de TwitterManager. Nadat de configuratie hiervan op orde is
            kan er met één commando al een bericht worden gepost of getweet:
        </p>
        <code class="prettyprint">
FacebookManager::getInstance()->post('Dit is een test-bericht');
TwitterManager::getInstance()->tweet('Dit is een test-tweet');
        </code>
        <p>
            Deze commando's kunnen nog verder uitgebreid worden met bijvoorbeeld een linkje of een caption.
        </p>
    </div>

    <h3 class="clickable">Hulp bij debuggen</h3>
    <div class="infoblock last">
        <p>
            Ook het debuggen is een belangrijke functie die niet vergeten mag worden. Om dat zo goed mogelijk te kunnen
            doen is de Logger klasse in het leven geroepen. Deze schrijft errors weg naar de database of een text
            bestand. Vervolgens worden de errors die op een bepaalde pagina zijn gegenereerd weergegeven door het
            volgende commando te gebruiken:
        </p>
        <code class="prettyprint">
Logger::getInstance()->printMessages();
        </code>
        <p>
            Daaruit komt dan voor iedere gelogde error een bericht met de error, het bestand waarin de error voorkwam en
            de regel code waar het fout ging. Op die manier kan er snel worden gezien waar de fout zit en waarom.
        </p>
    </div>
</div>