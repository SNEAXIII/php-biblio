<?php

namespace App\classes;

use DateTime;

class Magazine extends Media
{
    private int $numero;
    private DateTime $datePublication;

    /**
     * @param string $titre
     * @param int $numero
     * @param string $datePublication
     */
    public function __construct(string $titre, int $numero, string $datePublication)
    {
        $dureeEmprunt = 10;
        parent ::__construct($titre, $dureeEmprunt);
        $this -> numero = $numero;
        $this -> datePublication = DateTime ::createFromFormat("d/m/Y", $datePublication);
    }

    public function show(): string
    {
        return "Le magazine $this->titre numéro $this->numero a été publié le {$this->datePublication->format("d/m/Y")} et doit être restitué sous $this->dureeEmprunt";
    }


    /**
     * @return int
     */
    public function getNumero(): int
    {
        return $this -> numero;
    }

    /**
     * @return DateTime
     */
    public function getDatePublication(): DateTime
    {
        return $this -> datePublication;
    }
}