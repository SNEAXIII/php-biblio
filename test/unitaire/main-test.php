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

function showEntete($title): void
{
    echo ESC . GREEN_BACK . BLACK . "Tests : classe $title" . RESET . ESC;
}

function assertTestUnitaire(string $text, $input, $output): void
{
    echo LINE . "$text\n";
    // Assertion
    if ($input === $output) {
        echo GREEN . "Le test est valide" . RESET . ESC;
    } else {
        echo RED_BACK . "Le test n'est pas valide" . RESET . ESC;
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