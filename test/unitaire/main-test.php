<?php
require "test\utils\couleurs.php";

function getClassName($variable): string
{
    if (is_object($variable)) {
        return get_class($variable);
    } else {
        return gettype($variable);
    }
}

function assertTestUnitaire(string $text, $input, $output): void
{
    echo "$text\n";
    // Assertion
    if ($input === $output) {
        echo GREEN . "Le test est valide" . RESET . ESC;
    } else {
        echo RED . "Le test n'est pas valide" . RESET . ESC;
        echo LINE;
        $classeInput = getClassName($input);
        $classeOutput = getClassName($output);
        echo "L'entrée est un objet " . RED . $classeInput . RESET . ESC;
        echo "La valeur attendue est un objet " . RED . $classeOutput . RESET . ESC;
        echo "Souhaitez vous un " . RED . "dump des variables ?" . RESET . " : o/n" . ESC;
        echo LINE;
        $saisieUtilisateur = readline();
        if ($saisieUtilisateur == "o") {
            echo "Valeur entrée -->" . ESC;
            dump($input);
            echo LINE;
            echo "Valeur attendue -->" . ESC;
            dump($output);
            echo LINE;
        }
    }
}