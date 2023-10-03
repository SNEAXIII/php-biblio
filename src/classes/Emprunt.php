<?php

namespace App\classes;

use DateTime;

class Emprunt
{
    private DateTime $dateEmprunt;
    private DateTime $dateRetourEstime;
    private ?DateTime $dateRetourEffectif;
    private Adherent $adherent;
    private Media $media;

    /**
     * @param Adherent $adherent
     * @param Media $media
     */
    public function __construct(Adherent $adherent, Media $media)
    {
        $this->dateRetourEffectif = null;
        $this->dateEmprunt = new DateTime();
        $this->media = $media;
        $this->adherent = $adherent;
        $this->dateRetourEstime = (new DateTime())->modify("+{$this->media->getDureeEmprunt()}days");
    }

    /**
     * @return DateTime
     */
    public function getDateEmprunt(): DateTime
    {
        return $this->dateEmprunt;
    }

    /**
     * @return DateTime
     */
    public function getDateRetourEstime(): DateTime
    {
        return $this->dateRetourEstime;
    }

    /**
     * @return DateTime|null
     */
    public function getDateRetourEffectif(): ?DateTime
    {
        return $this->dateRetourEffectif;
    }

    /**
     * @return Adherent
     */
    public function getAdherent(): Adherent
    {
        return $this->adherent;
    }

    /**
     * @return Media
     */
    public function getMedia(): Media
    {
        return $this->media;
    }

    /**
     * @return string
     */
    public function show(): string
    {

        $result = "{$this->media->getTitre()} a été emprunté par {$this->adherent->getPrenom()} {$this->adherent->getNom()} le {$this->dateEmprunt->format("d/m/Y")} et devrait être retourné le {$this->dateRetourEstime->format("d/m/Y")}.";


        if ($this->ifEnCours()) {
            $result .= "Le media a été rendu le {$this->dateRetourEffectif->format("d/m/Y")}";
        }

        return $result;
    }

    public function ifEnCours(): bool
    {
        if (isset($this->dateRetourEffectif)) {
            return false;
        }
        return true;
    }

    public function ifEnAlerte(): bool
    {
        $ifAlerte = $this->dateRetourEstime < new DateTime();
        if ($this->ifEnCours() && $ifAlerte) {
            return true;
        }
        return false;
    }

    public function rendu(): void
    {
        if (!isset($this->dateRetourEffectif)) {
            $this->dateRetourEffectif = new DateTime();
        }
    }

    public function getdateEmpruntToString(): string
    {
        return $this->dateEmprunt->format("d/m/Y");
    }

    public function getDateRetourEffectifToString(): ?string
    {
        if (isset($this->dateRetourEffectif)) {
            return $this->dateRetourEffectif->format("d/m/Y");
        } else {
            return null;
        }
    }

    public function getDateRetourEstimeToString(): string
    {
        return $this->dateRetourEstime->format("d/m/Y");
    }

    public function setDateRetourNePasUtiliser(int $jours) : void {
        $this->dateEmprunt->modify("-{$jours}day");
        $this->dateRetourEstime->modify("-{$jours}day");
    }

}