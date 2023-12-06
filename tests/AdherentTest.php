<?php

namespace App\Tests;

use App\classes\Adherent;
use DateTime;
use PHPUnit\Framework\TestCase;

class AdherentTest extends TestCase
{
    /**
     * @test
     */
    public function CreateNewAdherent_WithoutDate_TodaysDate()
    {
        // Arrange
        $adherentDateNonDefinie = new Adherent("Almiche", "Ganache", "test@test.com");
        $valeurAttendueTestDateNonDefinie = (new DateTime())->format("d/m/Y");
        /// Act
        $valeurEntreeTestDateNonDefinie = $adherentDateNonDefinie->getDateAdhesionToString();
        // Assert
        $this->assertEquals(
            $valeurAttendueTestDateNonDefinie,
            $valeurEntreeTestDateNonDefinie
        );
    }

    /**
     * @test
     */
    public function CreateNewAdherent_WithtDate_SpecifiedDate()
    {
        // Arrange
        $dateDefinie = "05/11/2022";
        $adherentDateDefinie = new Adherent("Jamie", "Sacripan", "test@test.com", $dateDefinie);
        $valeurAttendueTestDateDefinie = $dateDefinie;
        // Act
        $valeurEntreeTestDateDefinie = $adherentDateDefinie->getDateAdhesionToString();
        // Assertion
        $this->assertEquals(
            $valeurAttendueTestDateDefinie,
            $valeurEntreeTestDateDefinie
        );
    }

    /**
     * @test
     */
    public function IfNewNumberIsValid_LenEqual9StartWithAD_NumberCorrect()
    {
        // Arrange
        $adherentNombreValide = new Adherent("Jamie", "Sacripan", "test@test.com",);
        // Act
        $numeroAdherent = $adherentNombreValide->getNumeroadherent();

        $ifTailleEgaleANeuf = strlen($numeroAdherent) == 9;
        $ifCommenceParABTiret = str_starts_with($numeroAdherent, "AD-");
        $ifContientNombreBienPlace = !preg_match("/[^0-9]/", (substr($numeroAdherent, 3)));

        // Assertion
        $this->assertTrue(
            $ifTailleEgaleANeuf
        );
        $this->assertTrue(
            $ifCommenceParABTiret
        );
        $this->assertTrue(
            $ifContientNombreBienPlace
        );
    }
}