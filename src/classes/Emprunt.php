<?php

namespace App\classes;

class Emprunt
{
    private \DateTime $dateEmprunt;
    private \DateTime $dateRetourEstime;
    private ?\DateTime $dateRetourEffectif;
    private Adherent $adherent;
    private Media $media;

    /**
     * @param \DateTime $dateEmprunt
     * @param \DateTime $dateRetourEstime
     * @param \DateTime|null $dateRetourEffectif
     * @param Adherent $adherent
     * @param Media $media
     */
    public function __construct(\DateTime $dateEmprunt, \DateTime $dateRetourEstime, Adherent $adherent, Media $media)
    {
        $this -> dateEmprunt = $dateEmprunt;
        $this -> dateRetourEstime = $dateRetourEstime;
        $this -> adherent = $adherent;
        $this -> media = $media;
    }

    /**
     * @return \DateTime
     */
    public function getDateEmprunt(): \DateTime
    {
        return $this -> dateEmprunt;
    }

    /**
     * @return \DateTime
     */
    public function getDateRetourEstime(): \DateTime
    {
        return $this -> dateRetourEstime;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateRetourEffectif(): ?\DateTime
    {
        return $this -> dateRetourEffectif;
    }

    /**
     * @return Adherent
     */
    public function getAdherent(): Adherent
    {
        return $this -> adherent;
    }

    /**
     * @return Media
     */
    public function getMedia(): Media
    {
        return $this -> media;
    }

    /**
     * @return string
     */
    public function show(): string
    {

        $result = "{$this->media->getTitre()} a été emprunté par {$this->adherent->getPrenom()} {$this->adherent->getNom()} le {$this->dateEmprunt->format("d/m/Y")} et devrait être retourné le {$this->dateRetourEstime->format("d/m/Y")}.";


        if ($this -> ifEnCours()) {
            $result .= "Le media a été rendu le {$this->dateRetourEffectif->format("d/m/Y")}";
        }

        return $result;
    }

    public function ifEnCours(): bool
    {
        if (isset($this -> dateRetourEffectif)) {
            return false;
        }
        return true;
    }

    public function ifEnAlerte(): bool
    {

        $dateButoir = (clone $this -> dateEmprunt) -> modify("+{$this->media->getDureeEmprunt()}day");
        $ifAlerte = $this -> dateRetourEstime > $dateButoir;
        if ($this -> ifEnCours() && $ifAlerte) {
            return true;
        }
        return false;
    }
}