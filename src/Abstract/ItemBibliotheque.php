<?php

namespace App\Abstract;
abstract class ItemBibliotheque {
    private string $titre;
    public function __construct($titre){
        $this->titre = $titre;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    public function afficherInfos(): void
    {
        echo "\n";
        echo "\tTitre : " .$this->titre . "\n";
    }
}