<?php

function stampaNumeri($numero)
{

    if ($numero == 0)
        return;
    else {
        //stampa numero sucessivo
        stampaNumeri($numero - 1);
        //stampa numero corrente
        echo $numero . PHP_EOL;
    }

}

stampaNumeri(10);

function scorriArray($array, $i)
{
    if ($i < count($array)) {
        $el = $array[$i];

        if (is_array($el)) {
            echo "-" . PHP_EOL;
            scorriArray($el, 0);
        } else {
            echo $el . ",";

            scorriArray($array, $i + 1);
        }
    }
}

$array = [1, 2, [1, 2, [1, 2, 3, [1, 2, 3]]]];

//scorriArray($array, 0);