<?php

use App\classes\Adherent;


require "test\unitaire\main-test.php";
require "vendor\autoload.php";

// Fonction récuperée sur internet
function isDigits($string): bool
{
    return !preg_match("/[^0-9]/", $string);
}

function testNumeroAdherent(string $numeroAdherent): bool
{
    $ifTailleEgaleANeuf = strlen($numeroAdherent) == 9;
    $ifCommenceParABTiret = str_starts_with($numeroAdherent, "AD-");
    $ifContientNombreBienPlace = isDigits(substr($numeroAdherent, 3));
    if ($ifTailleEgaleANeuf && $ifCommenceParABTiret && $ifContientNombreBienPlace) {
        return true;
    }
    return false;
}

showEntete("Adherent");


//  vérifier que la date d’adhésion, si non précisée à la création,est égale à ladate du jour
$textTestDateNonDefinie = "Test: vérifier que la date d’adhésion, si non précisée à la création, est égale à la date du jour";

// Arrange
$adherentDateNonDefinie = new Adherent("Almiche", "Ganache", "test@test.com");
$valeurAttendueTestDateNonDefinie = (new DateTime())->format("d/m/Y");

// Act
$valeurEntreeTestDateNonDefinie = $adherentDateNonDefinie->getDateAdhesionToString();

// Assert
assertTestUnitaire(
    $textTestDateNonDefinie,
    $valeurEntreeTestDateNonDefinie,
    $valeurAttendueTestDateNonDefinie
);

// vérifier que la date d’adhésion, si précisée à la création, est bien prise en compte
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


// vérifier que le numéro d’adhérent, à la création, est valide
$textTestNombreValide = "Test: vérifier que le numéro d’adhérent, à la création, est valide";
// Arrange
$adherentNombreValide = new Adherent("Jamie",
    "Sacripan", "test@test.com",);
$valeurAttendueTestNombreValide = true;
// Act
$valeurEntreeTestNombreValide = testNumeroAdherent($adherentNombreValide->getNumeroadherent());
// Assertion
assertTestUnitaire(
    $textTestNombreValide,
    $valeurEntreeTestNombreValide,
    $valeurAttendueTestNombreValide
);


// vérifier  que  l’adhésion est valable  (valide)  quand  la  date d’adhésion n’est pas dépassée (moins d’un an)
$textTestEncours = "Test: vérifier  que  l’adhésion est valable  (valide)  quand  la  date d’adhésion n’est pas dépassée (moins d’un an)";
// Arrange
$adherentEncours = new Adherent("Jack",
    "Trompette", "test@test.com");
$adherentEncours->getDateAdhesion()->modify("-6month");
$valeurAttendueTestEncours = true;
// Act
$valeurEntreeTestEncours = $adherentEncours->ifAbonnementEnCours();
// Assert
assertTestUnitaire(
    $textTestEncours,
    $valeurEntreeTestEncours,
    $valeurAttendueTestEncours
);


// vérifier  que  l’adhésion est non  valable  (invalide)  quand  la  date d’adhésion est dépassée (plus d’un an)
$textTestPasEncours = "Test: vérifier  que  l’adhésion est non  valable  (invalide)  quand  la  date d’adhésion est dépassée (plus d’un an)";
// Arrange
$adherentPasEncours = new Adherent("Jack",
    "Trompette", "test@test.com");
$adherentPasEncours->getDateAdhesion()->modify("-14month");
$valeurAttendueTestPasEncours = false;
// Act
$valeurEntreeTestPasEncours = $adherentPasEncours->ifAbonnementEnCours();
// Assert
assertTestUnitaire(
    $textTestPasEncours,
    $valeurEntreeTestPasEncours,
    $valeurAttendueTestPasEncours
);


// valable  (valide)  quand  la  date d’adhésion n’est pas dépassée (moins d’un an)
$textTestRenouvellement = "Test valable  (valide)  quand  la  date d’adhésion n’est pas dépassée (moins d’un an)";
// Arrange
$dateAdhestion = "05/05/2023";
$adherentRenouvellement = new Adherent("James",
    "Chapelin", "test@test.com", $dateAdhestion);
$valeurAttendueTestRenouvellement =
    \DateTime::createFromFormat("d/m/Y", $dateAdhestion)
        ->modify("+1year")
        ->format("d/m/Y");
// Act
$adherentRenouvellement->renouvelerAdhesion();
$valeurEntreeTestRenouvellement = $adherentRenouvellement->getDateAdhesionToString();
// Assert
assertTestUnitaire(
    $textTestRenouvellement,
    $valeurEntreeTestRenouvellement,
    $valeurAttendueTestRenouvellement
);
