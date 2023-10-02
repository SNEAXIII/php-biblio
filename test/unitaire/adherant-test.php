<?php

use App\classes\Adherant;

require "test\utils\couleurs.php";
require "vendor\autoload.php";

$dateAdhestionCustom = "20/01/2000";

$adherantDateDefinie = new Adherant("Jamie",
    "Sacripan", "test@test.com", $dateAdhestionCustom);
$adherantDatenonDefinie = new Adherant("Almiche",
    "Ganache", "test@test.com");

echo "Test de creation de nouvel adhérant avec une date définie \n";
if ($adherantDateDefinie->getDateAdhesion() == $dateAdhestionCustom) {
    echo GREEN."Le test est valide".RESET;
}

//dump($adherantDateDefinie);
//dump($adherantDatenonDefinie);
