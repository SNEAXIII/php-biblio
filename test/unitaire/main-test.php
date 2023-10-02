<?php
require "test\utils\couleurs.php";

function getClassName($variable)
{
    if (is_object($variable)) {
        return get_class($variable);
    } else {
        return gettype($variable);
    }
}

function testUnitaire(string $text, $output, $input): void
{
    echo "$text\n";
    if ($input === $output) {
        echo GREEN . "Le test est valide" . RESET . ESC;
    } else {
        echo RED . "Le test n'est pas valide" . RESET . ESC;
        $classeInput = getClassName($input);
        $classeOutput = getClassName($output);
        echo "L'entrée est un objet " . RED . $classeInput . RESET . ESC;
        echo "La valeur attendue est un objet ". RED .$classeOutput. RESET . ESC;
        echo "Souhaitez vous un dump ? : o/n".ESC;
        $saisieUtilisateur = readline();
        if ($saisieUtilisateur == "o") {
            echo "Entrée -->".ESC;
            dump($input);
            echo "_____________________________________".ESC;
            echo "Valeur attendue -->".ESC;
            dump($output);
            echo "_____________________________________";
        }
    }
}