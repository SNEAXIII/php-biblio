<?php

use App\classes\Adherent;


require "test\unitaire\main-test.php";
require "vendor\autoload.php";

echo ESC;
echo GREEN_BACK . BLACK;
echo "Tests : classe Adherent";
echo RESET;
echo ESC;

// Test numéro 1
$textTest1 = "On vérifie si la date ajoutée en paramètre est bien prise en compte lors de la création de l'instance";
// Arrange
$dateAdhestionDefinie = "05/11/2022";
$adherentDateDefinie = new Adherent("Jamie",
    "Sacripan", "test@test.com", $dateAdhestionDefinie);
$valeurAttendueTest1 = $dateAdhestionDefinie;
// Act
$valeurEntreeTest1 = $adherentDateDefinie->getDateAdhesionToString();
// Assertion
assertTestUnitaire(
    $textTest1,
    $valeurEntreeTest1,
    $valeurAttendueTest1
);


// Test numéro 2
$textTest2 = "On vérifie si le fait de ne pas mettre de date lors de la création de l'instance entraine que la date de l'adhesion soit aujourd'hui";
// Arrange
$adherentDateNonDefinie = new Adherent("Almiche",
    "Ganache", "test@test.com");
$valeurAttendueTest2 = (new DateTime())->format("d/m/Y");
// Act
$valeurEntreeTest2 = $adherentDateNonDefinie->getDateAdhesionToString();
// Assert
assertTestUnitaire(
    $textTest2,
    $valeurEntreeTest2,
    $valeurAttendueTest2
);

// Test numéro 3
$textTest3 = "On regarde si l'abonnement est toujours valide";
// Arrange
$dateAdhestion = "05/07/2023";
$adherentEncours = new Adherent("Jack",
    "Trompette", "test@test.com", $dateAdhestion);
$valeurAttendueTest3 = true;
// Act
$valeurEntreeTest3 = $adherentEncours->ifAbonnementEnCours();
// Assert
assertTestUnitaire(
    $textTest3,
    $valeurEntreeTest3,
    $valeurAttendueTest3
);


// Test numéro 4
$textTest4 = "On renouvelle pour 1 an l'abonnement";
// Arrange
$dateAdhestion = "05/05/2023";
$adherentEncours = new Adherent("James",
    "Chapelin", "test@test.com", $dateAdhestion);
$valeurAttendueTest4 =
    \DateTime::createFromFormat("d/m/Y", $dateAdhestion)
        ->modify("+1year")
        ->format("d/m/Y");
// Act
$adherentEncours->renouvelerAdhesion();
$valeurEntreeTest4 = $adherentEncours->getDateAdhesionToString();
// Assert
assertTestUnitaire(
    $textTest4,
    $valeurEntreeTest4,
    $valeurAttendueTest4
);


//dump($adherentDateDefinie);
//dump($adherentDatenonDefinie);
