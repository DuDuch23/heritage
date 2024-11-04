<?php

namespace App\Class;

class Media{
    private $id;
    private string $titre;
    private string $auteur;
    private bool $disponible = true; // Par défaut

    public function __construct($id, string $titre, string $auteur, bool $disponible) {
        $this->id = $id;
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->disponible = $disponible;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $newTitre): void
    {
        $this->titre = $newTitre;
    }

    public function getAuteur(): string
    {
        return $this->auteur;
    }

    public function setAuteur(string $newAuteur): void
    {
        $this->auteur = $newAuteur;
    }

    public function getDisponible(): bool
    {
        return $this->disponible;
    }

    public function setDisponible(bool $newDisponible): void
    {
        $this->disponible = $newDisponible;
    }

    public function emprunter(){
        return $this->titre . " de " . $this->auteur . " est " . ($this->disponible ? "disponible." : "non disponible.");
    }

    public function rendre(){
        return $this->titre . " de " . $this->auteur . " est " . ($this->disponible ? "est disponible." : "doit être rendu.");
    }
}