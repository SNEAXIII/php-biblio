<?php

use App\classes\Adherant;


require "test\unitaire\main-test.php";
require "vendor\autoload.php";

$dateAdhestionCustom = "20/01/2000";

$adherantDateDefinie = new Adherant("Jamie",
    "Sacripan", "test@test.com", $dateAdhestionCustom);
$adherantDatenonDefinie = new Adherant("Almiche",
    "Ganache", "test@test.com");


testUnitaire(
    "Verification si un nouvel adhérant créé avec une date définie",
    $adherantDateDefinie->getDateAdhesion(),
    $dateAdhestionCustom
);


//dump($adherantDateDefinie);
//dump($adherantDatenonDefinie);
