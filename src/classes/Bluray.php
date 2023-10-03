<?php

namespace App\classes;

class Bluray extends Media
{
    private string $realisateur;
    private int $duree;
    private int $anneeSortie;

    /**
     * @param string $titre
     * @param string $realisateur
     * @param int $duree
     * @param int $anneeSortie
     */
    public function __construct(string $titre, string $realisateur, int $duree, int $anneeSortie)
    {
        $dureeEmprunt = 15;
        parent ::__construct($titre, $dureeEmprunt);
        $this -> realisateur = $realisateur;
        $this -> duree = $duree;
        $this -> anneeSortie = $anneeSortie;
    }
    public function show(): string
    {
        return "Le titre du blu-ray est $this->titre, son réalisateur est $this->realisateur, sortis en $this->anneeSortie, fait $this->duree minutes et doit etre restitué en $this->dureeEmprunt jours.";
    }
}