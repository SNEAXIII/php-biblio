<?php

namespace App\classes;

class Livre extends Media
{
    private string $isbn;
    private string $auteur;
    private int $nombrePages;

    /**
     * @param string $titre
     * @param string $isbn
     * @param string $auteur
     * @param int $nombrePages
     */
    public function __construct(string $titre, string $isbn, string $auteur, int $nombrePages)
    {
        $dureeEmprunt = 21;
        parent ::__construct($titre, $dureeEmprunt);
        $this -> isbn = $isbn;
        $this -> auteur = $auteur;
        $this -> nombrePages = $nombrePages;
    }

    public function show(): string
    {
        return "Le titre du livre est $this->titre, son ISBN est $this->isbn, écrit par $this->auteur, fait $this->nombrePages pages et doit être restitué en $this->dureeEmprunt jours.";
    }

}