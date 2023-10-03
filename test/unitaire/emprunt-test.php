<?php


use App\classes\Adherent;
use App\classes\Bluray;
use App\classes\Emprunt;
use App\classes\Livre;
use App\classes\Magazine;


require "test\unitaire\main-test.php";
require "vendor\autoload.php";


showEntete("Emprunt");

// Arrange global
$livre = new Livre("1984", "55555555ab", "Legitimus", 999);
$blueray = new Bluray("1984", "Legitimus", "200", 1984);
$magazine = new Magazine("1984", 55, "05/07/1984");
$adherent = new Adherent("Durif", "Sylvain", "test@test.com");


//vérifier que la date d’emprunt, à la création, est égale à la date du jour
$textTestDateCreationEgalDateJour = "Test: vérifier que la date d’emprunt, à la création, est égale à la date du jour";

// Arrange
$empruntDateCreationEgalDateJour = new Emprunt($adherent, $livre);
$valeurAttendueTestDateCreationEgalDateJour = (new DateTime()) -> format("d/m/Y");

// Act
$valeurEntreeTestDateCreationEgalDateJour = $empruntDateCreationEgalDateJour -> getdateEmpruntToString();

// Assert
assertTestUnitaire(
    $textTestDateCreationEgalDateJour,
    $valeurEntreeTestDateCreationEgalDateJour,
    $valeurAttendueTestDateCreationEgalDateJour
);


// vérifier que la date de retour estimée, à la création, est égale à la date du jour + 21 jours pour l’emprunt d’un livre
$textTestDateCreationPlus21Jours = "Test: vérifier que la date de retour estimée, à la création, est égale à la date du jour + 21 jours pour l’emprunt d’un livre";

// Arrange
$empruntDateCreationPlus21Jours = new Emprunt($adherent, $livre);
$valeurAttendueTestDateCreationPlus21Jours = (new DateTime()) -> modify("+21day") -> format("d/m/Y");

// Act
$valeurEntreeTestDateCreationPlus21Jours = $empruntDateCreationPlus21Jours -> getDateRetourEstimeToString();

// Assert
assertTestUnitaire(
    $textTestDateCreationPlus21Jours,
    $valeurEntreeTestDateCreationPlus21Jours,
    $valeurAttendueTestDateCreationPlus21Jours
);


// vérifier que la date de retour estimée, à la création, est égale à la date du jour + 21 jours pour l’emprunt d’un livre
$textTestDateCreationPlus15Jours = "Test: vérifier que la date de retour estimée, à la création, est égale à la date du jour + 15 jours pour l’emprunt d’un livre";

// Arrange
$empruntDateCreationPlus15Jours = new Emprunt($adherent, $blueray);
$valeurAttendueTestDateCreationPlus15Jours = (new DateTime()) -> modify("+15day") -> format("d/m/Y");

// Act
$valeurEntreeTestDateCreationPlus15Jours = $empruntDateCreationPlus15Jours -> getDateRetourEstimeToString();

// Assert
assertTestUnitaire(
    $textTestDateCreationPlus15Jours,
    $valeurEntreeTestDateCreationPlus15Jours,
    $valeurAttendueTestDateCreationPlus15Jours
);


// vérifier que la date de retour estimée, à la création, est égale à la date du jour + 21 jours pour l’emprunt d’un livre
$textTestDateCreationPlus10Jours = "Test: vérifier que la date de retour estimée, à la création, est égale à la date du jour + 10 jours pour l’emprunt d’un livre";

// Arrange
$empruntDateCreationPlus10Jours = new Emprunt($adherent, $magazine);
$valeurAttendueTestDateCreationPlus10Jours = (new DateTime()) -> modify("+10day") -> format("d/m/Y");

// Act
$valeurEntreeTestDateCreationPlus10Jours = $empruntDateCreationPlus10Jours -> getDateRetourEstimeToString();

// Assert
assertTestUnitaire(
    $textTestDateCreationPlus10Jours,
    $valeurEntreeTestDateCreationPlus10Jours,
    $valeurAttendueTestDateCreationPlus10Jours
);


// vérifier que l’emprunt est en cours quand la date de retour n’est pas renseignée
$textTestEmpruntEnCours = "Test: vérifier que l’emprunt est en cours quand la date de retour n’est pas renseignée";

// Assert
$empruntEmpruntEnCours = new Emprunt($adherent, $livre);
$valeurAttendueEmpruntEnCours = true;

// Act
$valeurEntreeEmpruntEnCours = $empruntEmpruntEnCours -> ifEnCours();

// Assert
assertTestUnitaire(
    $textTestEmpruntEnCours,
    $valeurEntreeEmpruntEnCours,
    $valeurAttendueEmpruntEnCours
);


// vérifier que l’emprunt est en alerte quand la date de retour estimée est antérieure à la date du jour et que l’emprunt est en cours
$textTestEnAlerte = "Test: vérifier que l’emprunt est en alerte quand la date de retour estimée est antérieure à la date du jour et que l’emprunt est en cours";

// Arrange
$empruntEmpruntEnAlerte = $empruntEmpruntEnCours = new Emprunt($adherent, $livre);
// On soustrait 30 jours sur la date d'emprunt et d'emprunt estimé avec une méthode secrete
$empruntEmpruntEnAlerte -> modifyDateRetourNePasUtiliser(-30);
$valeurAttendueEnAlerte = true;

// Act
$valeurEntreeEnAlerte = $empruntEmpruntEnAlerte -> ifEnAlerte();

// Assert
assertTestUnitaire(
    $textTestEnAlerte,
    $valeurEntreeEnAlerte,
    $valeurAttendueEnAlerte
);


// vérifier que la durée de l’emprunt a été dépassée quand la date de retour est postérieure à la date de retour estimée
$textTestEmpruntDepasse = "Test : vérifier que la durée de l’emprunt a été dépassée quand la date de retour est postérieure à la date de retour estimée";

// Arrange
$empruntEmpruntDepasse = new Emprunt($adherent, $livre);
// On soustrait 30 jours sur la date d'emprunt et d'emprunt estimé avec une méthode secrete
$empruntEmpruntDepasse -> modifyDateRetourNePasUtiliser(-30);
// On simule un retour du média
$empruntEmpruntDepasse -> rends();
$valeurAttendueEmpruntDepasse = true;

// Act
$valeurEntreeEmpruntDepasse = $empruntEmpruntDepasse -> ifRenduEnRetard();

// Assert
assertTestUnitaire($textTestEmpruntDepasse,
    $valeurEntreeEmpruntDepasse,
    $valeurAttendueEmpruntDepasse);