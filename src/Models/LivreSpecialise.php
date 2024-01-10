<?php

namespace App\Models;

class LivreSpecialise extends Livre {

    private string $domaine;
    public function __construct($titre, $auteur, $anneePublication, $domaine)
    {
        parent::__construct($titre, $auteur, $anneePublication);
        $this->domaine = $domaine;
    }

    public function getDomaine(): string
    {
        return $this->domaine;
    }

    public function setDomaine(string $domaine): void
    {
        $this->domaine = $domaine;
    }

    #[\Override]
    public function afficherInfos(): void
    {
        parent::afficherInfos();
        echo "\tDomaine : ". $this->domaine . "\n";
    }


}