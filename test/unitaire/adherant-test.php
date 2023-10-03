<?php

use App\classes\Adherent;


require "test\unitaire\main-test.php";
require "vendor\autoload.php";

// Fonction récuperée sur internet
function isDigits($string): bool
{
    return !preg_match ("/[^0-9]/", $string);
}
function testNumeroAdherent (string $numeroAdherent) : bool {
    $ifTailleEgaleANeuf = strlen($numeroAdherent) == 9;
    $ifCommenceParABTiret = str_starts_with($numeroAdherent, "AB-");
    $ifContientNombreBienPlace = isDigits(substr($numeroAdherent,3));
    if ($ifTailleEgaleANeuf && $ifCommenceParABTiret && $ifContientNombreBienPlace) {
        return true;
    }
    return false;
}

echo ESC;
echo GREEN_BACK . BLACK;
echo "Tests : classe Adherent";
echo RESET;
echo ESC;


//  vérifier que la date d’adhésion, si non précisée à la création,est égale à ladate du jour
$textTestDateNonDefinie = "Test: vérifier que la date d’adhésion, si non précisée à la création, est égale à la date du jour";

// Arrange
$adherentDateNonDefinie = new Adherent("Almiche","Ganache", "test@test.com");
$valeurAttendueTestDateNonDefinie = (new DateTime())->format("d/m/Y");

// Act
$valeurEntreeTestDateNonDefinie = $adherentDateNonDefinie->getDateAdhesionToString();

// Assert
assertTestUnitaire(
    $textTestDateNonDefinie,
    $valeurEntreeTestDateNonDefinie,
    $valeurAttendueTestDateNonDefinie
);

// vérifier que la date d’adhésion, si précisée à la création, est bien prise en compte"
$textTestDateDefinie = "Test: vérifier que la date d’adhésion, si précisée à la création, est bien prise en compte";
// Arrange
$dateDefinie = "05/11/2022";
$adherentDateDefinie = new Adherent("Jamie",
    "Sacripan", "test@test.com", $dateDefinie);
$valeurAttendueTestDateDefinie = $dateDefinie;
// Act
$valeurEntreeTestDateDefinie = $adherentDateDefinie->getDateAdhesionToString();
// Assertion
assertTestUnitaire(
    $textTestDateDefinie,
    $valeurEntreeTestDateDefinie,
    $valeurAttendueTestDateDefinie
);




// Test numéro 3
$textTest3 = "On regarde si l'abonnement est toujours valide";
// Arrange
$adherentEncours = new Adherent("Jack",
    "Trompette", "test@test.com");
$adherentEncours->getDateAdhesion()->modify("-6month");
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
