<?php

use App\classes\Adherent;


require "test\unitaire\main-test.php";
require "vendor\autoload.php";

$dateAdhestionCustom = "05/11/2022";

$adherentDateDefinie = new Adherent("Jamie",
    "Sacripan", "test@test.com", $dateAdhestionCustom);
$adherentDatenonDefinie = new Adherent("Almiche",
    "Ganache", "test@test.com");

testUnitaire(
    "On vérifie si la date ajoutée en paramètre est bien prise en compte lors de la création de l'instance",
    $adherentDateDefinie -> getDateAdhesionToString(),
    $dateAdhestionCustom
);
testUnitaire(
    "On vérifie si ne pas mettre de date entraine une création de l'instance avec la date d'aujourd'hui",
    $adherentDatenonDefinie -> getDateAdhesionToString(),
    (new DateTime()) -> format("d/m/Y")
);


testUnitaire(
    "On regarde si l'abonnement est toujours valide",
    $adherentDateDefinie->ifAbonnementEnCours(),
    false
);


//On renouvelle pour 1 an l'abonnement
$adherentDateDefinie -> renouvelerAdhesion();

testUnitaire(
    "On renouvelle pour 1 an l'abonnement",
    $adherentDateDefinie -> getDateAdhesionToString(),
    \DateTime ::createFromFormat("d/m/Y", $dateAdhestionCustom) -> modify("+1year") -> format("d/m/Y")
);


//dump($adherentDateDefinie);
//dump($adherentDatenonDefinie);
