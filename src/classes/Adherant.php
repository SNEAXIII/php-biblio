<?php

namespace App\classes;

class Adherant
{
    private string $numeroAdherant;
    private string $nom;
    private string $prenom;
    private string $email;
    private ?\DateTime $dateAdhesion;

    /**
     * @param string $nom
     * @param string $prenom
     * @param string $email
     * @param string|null $dateAdhesion
     */
    public function __construct(string $nom, string $prenom,
                                string $email, ?string $dateAdhesion = null)
    {
        date_default_timezone_set("Europe/Paris");

        $this->numeroAdherant = $this->genererNumero();
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;

        // On verifie si une date est saisie, et si ce n'est pas le cas la date d'adhésion sera égale à aujourd'hui
        if (is_null($dateAdhesion)) {
            $this->dateAdhesion = new \DateTime();
        } else {
            $this->dateAdhesion = \DateTime::createFromFormat("d/m/Y", $dateAdhesion);
        }
    }

    private function genererNumero(): string
    {
        // On genere un numéro aléatoire
        $randNumber = rand(0, 999999);

        // On le formate pour qu'il corresponde au format "XXXXXX"
        $numberFormat = sprintf("%'.06d", $randNumber);

        // On le concatène au format "AD-XXXXXXX"
        return "AD-{$randNumber}";
    }
    public function renouvelerAdhesion() : void {
        $this->dateAdhesion->modify("+1year");
    }
    /**
     * @return string
     */
    public function getNumeroAdherant(): string
    {
        return $this->numeroAdherant;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getDateAdhesion(): string
    {
        return $this->dateAdhesion->format("d/m/Y");
    }


}