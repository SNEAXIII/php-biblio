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

function testUnitaire(string $text, $input, $output): void
{
    echo "$text\n";
    if ($input === $output) {
        echo GREEN . "Le test est valide" . RESET . ESC;
    } else {
        echo RED . "Le test n'est pas valide" . RESET . ESC;
        $classeInput = getClassName($input);
        $classeOutput = getClassName($output);
        echo "L'entrée est un objet " . RED . $classeInput . RESET . ESC;
        echo "La valeur attendue est un objet " . RED . $classeOutput . RESET . ESC;
        echo "Souhaitez vous un " . RED . "dump des variables ?" . RESET . " : o/n" . ESC;
        $saisieUtilisateur = readline();
        if ($saisieUtilisateur == "o") {
            echo LINE;
            echo "Valeur entrée -->" . ESC;
            dump($input);
            echo LINE;
            echo "Valeur attendue -->" . ESC;
            dump($output);
            echo LINE;
        }
    }
}