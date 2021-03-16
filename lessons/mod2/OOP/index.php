<?php

//DRY Do not repeat yourself

//classe --> oggetto --> istanza

/*
 * VANTAGGI
 * - riusabilità del codice
 * - refactoring
 * - modularità
 * - erededitarietà o estendibilità (di metodi e attributi)
 * - manutenzione
 * - efficienza e produttività
 */

class NomeClasse
{
    private $attributoPrivato;

    public $attirbutoPubblico;

    public function __construct()
    {
        echo "Costruttore avviato" . PHP_EOL;
    }

    public function metodoPubblico()
    {

    }

}

//creo gli oggetti (e quindi le istanze)
$oggetto1 = new NomeClasse();
$oggetto2 = new NomeClasse();

//accedo alle proprietà e ai metodi degli oggetti
$oggetto1->attirbutoPubblico = 6;
$oggetto1->metodoPubblico();

$oggetto2->attirbutoPubblico = 10;
$oggetto2->metodoPubblico();


abstract class Persona
{
    const MAX_CIFRE_CF = 16;

    private $nome;

    private $cognome;

    public $sesso;

    protected $dna;

    protected $codiceFiscale;

    private $nazionalita;

    public function __construct($cognome, $nome = null, $codiceFiscale = null)
    {
        $this->nome = $nome;
        $this->cognome = $cognome;

        if (strlen($codiceFiscale) == self::MAX_CIFRE_CF)
            $this->codiceFiscale = $codiceFiscale;
        else {
            $this->codiceFiscale = "ERROR";
        }
    }

    /**
     * eseguita prima della cancellazione dell'oggetto in memoria
     * viene gestito dal GarbageCollector
     */
    public function __destruct()
    {
        echo "distruzione" . PHP_EOL;
    }


    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getCognome()
    {
        return $this->cognome;
    }

    /**
     * @param mixed $cognome
     */
    public function setCognome($cognome)
    {
        $this->cognome = $cognome;
    }

    /**
     * Stampa a video nome e cognome
     */
    public function stampa()
    {
        echo $this->cognome . " " . $this->nome . PHP_EOL;
    }

    public static function fromString($string)
    {
        $splittedString = explode(" ", $string);

        $nome = $splittedString[0];
        $cognome = $splittedString[1];

        $persona = Persona::buildFromString($cognome, $nome);

        return $persona;
    }

    abstract static function buildFromString($cognome, $nome);

    public function getCodiceFiscale()
    {
        return $this->codiceFiscale;
    }

    public function calcolaCF()
    {
        $this->codiceFiscale = substr($this->nome, 0, 3) . substr($this->nome, 0, 3) . $this->codiceNazionalita();
    }

    //in alternativa alle clasi astratte pensate prima agli override
    public abstract function codiceNazionalita();

    //public function codiceNazionalita(){
    //da implementare nei figli all'occorrenza
    //oppure inserire un default che va bene per tutti i figli
    //return "IT";
    //}

}

class Adulto extends Persona
{

    static function buildFromString($cognome, $nome)
    {
        return new Adulto($cognome, $nome);
    }

    public function codiceNazionalita()
    {
        return "IT";
    }
}

class Adolescente extends Persona
{

    static function buildFromString($cognome, $nome)
    {
        return new Adolescente($cognome, $nome);
    }

    public function codiceNazionalita()
    {
        return "IT";
    }
}

class Bambino extends Persona
{

    static function buildFromString($cognome, $nome)
    {
        return new Bambino($cognome, $nome);
    }

    public function codiceNazionalita()
    {
        return "IT";
    }
}

class Straniera extends Persona
{


    static function buildFromString($cognome, $nome)
    {
        return new Straniera();
    }

    public function codiceNazionalita()
    {
        return "EXT";
    }
}

$paolo = new Adulto("mistretta", "paolo");
$marco = new Adulto("de felice", "marco");
$giuseppe = new Adulto("orlando");

$gaggioMarco = Persona::fromString("marco gaggio");


//echo $paolo->getCognome() . " " . $paolo->getNome() . PHP_EOL;
//echo $giuseppe->getCognome() . " " . $giuseppe->getNome() . PHP_EOL;
$paolo->stampa();
$giuseppe->stampa();
$gaggioMarco->stampa();

class Figlio extends Persona
{

    public function __construct($cognome, $nome = null, $codiceFiscale = null)
    {
        //azioni
        parent::__construct($cognome, $nome, $codiceFiscale);
        //azioni
    }

    public function stampa()
    {
        //parent::stampa();
        //echo parent::getCodiceFiscale();
        echo $this->getCognome() . " " . $this->getNome() . " " . $this->getCodiceFiscale() . PHP_EOL;
    }


    static function buildFromString($cognome, $nome)
    {
        // TODO: Implement buildFromString() method.
    }

    public function codiceNazionalita()
    {
        // TODO: Implement codiceNazionalita() method.
    }
}


$figlio1 = new Figlio("parente mistretta", "carlo", "CRLMST");

$figlio1->stampa();

$figlio1->calcolaCF();

//final class impedirebbe di ereditare la classe

