<?php

namespace App\classes;

class Bluray extends Media
{
    private string $realisateur;
    private int $duree;
    private \DateTime $anneeSortie;

    /**
     * @param string $titre
     * @param string $realisateur
     * @param int $duree
     * @param string $anneeSortie
     */
    public function __construct(string $titre, string $realisateur, int $duree, string $anneeSortie)
    {
        $dureeEmprunt = 15;
        parent ::__construct($titre, $dureeEmprunt);
        $this -> realisateur = $realisateur;
        $this -> duree = $duree;
        $this -> anneeSortie = \DateTime::createFromFormat("d/m/Y",$anneeSortie);
    }
    public function show(): string
    {
        return "Le titre du blu-ray est $this->titre, son réalisateur est $this->realisateur, sortis en {$this->anneeSortie->format("d/m/Y")}, fait $this->duree minutes et doit etre restitué en $this->dureeEmprunt jours.";
    }
}