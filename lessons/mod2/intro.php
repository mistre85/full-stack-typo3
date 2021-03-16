<?php

$data = 5; //in js questa è globale, ma in php no!
$stringa = "Il numero è $data!";
$stringa = "il numero è " . $data . "!"; //concatenazione

$quotata = 'il numero è $data';

$array = array(1, 2, 3, 4);
$arrayMix = array(1, "2", array(1, 2));
$compatto = [];
$compatto = [1, 2, 3];

$compatto[] = 1; //aggiunge un valore

$nomeUtente = "paolo";

//variabili dell'utente

$numeroPostUtente = 5;
$numeroPostTotali = 10;
$listaPostUtente = [];

echo "Benevenuto Paolo";
echo "<h1>Benvenuto Paolo</h1>";

function stampaDato()
{
    $x = 0;
    global $data;
    echo $data;
}

//stampaDato();

//echo $x;

$italiano = "Ciao";
$inglese = "Hello";

echo $italiano . " Paolo";
echo $inglese . " Paolo";

$linguaSelezionata = "italiano";

echo $$linguaSelezionata . " Paolo";

switch ($linguaSelezionata) {
    case 'italiano':
        echo $italiano . " Paolo";
        break;
    case 'inglese':
        echo $inglese . " Paolo";
        break;
}

//valore costante
define('NUM_MAX_UTENTI', 100);

var_dump(get_defined_constants(true));

echo __DIR__ . PHP_EOL;
echo __FILE__ . PHP_EOL;

function esempioCostanteMethod()
{
    echo __METHOD__ . PHP_EOL;
}

//casting
echo "1" == 1;

//casting
echo "1" === 1;

$errore = 2;
switch ($errore) {
    case 1:
        echo " err" . $errore;
        break;
    case 2:
        echo " err" . $errore;
        break;
    case 3:
        echo " err" . $errore;
        break;
    case 4:
        echo " err" . $errore;
        break;
    case 5:
        echo " err" . $errore;
        break;
}

if ($data > 0) {

} else {

}

$condizione = true;
$esito = $condizione ? true : false;

for ($i = 0; i < 10; $i++) {

}

$elements = [1, 2, 3];

foreach ($elements as $element) {
    echo $element;
}

$elements = ['primo' => 1, 'secondo' => 2, 'terzo' => 3];

foreach ($elements as $key => $element) {
    echo $element;
}



//stampaNumeri(0);