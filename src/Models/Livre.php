<?php


namespace App\Models;

use App\Abstract\ItemBibliotheque;
use App\Exceptions\LivreException;
use App\Traits\Loggable;

class Livre extends ItemBibliotheque {
    use Loggable;
    private string $auteur;
    private int $anneePublication;

    /**
     * @throws LivreException
     */
    public function __construct($titre, $auteur, $anneePublication)
    {
        if (is_null($titre) || is_null($auteur) || is_null($anneePublication)){
            throw new LivreException("Les informations ne pas renseignées correctement");
        }
        parent::__construct($titre);
        $this->auteur = $auteur;
        $this->anneePublication = $anneePublication;
        $this->log($titre." de ".$auteur." publié en ".$anneePublication." à été créé.");
    }

    public function getAuteur(): string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): void
    {
        $this->auteur = $auteur;
    }

    public function getAnneePublication(): int
    {
        return $this->anneePublication;
    }

    public function setAnneePublication(int $anneePublication): void
    {
        $this->anneePublication = $anneePublication;
    }

    #[\Override]
    public function afficherInfos(): void
    {
        parent::afficherInfos();
        echo "\tAuteur : " .$this->auteur . "\n";
        echo "\tAnnée de publication : " .$this->anneePublication . "\n";
    }


}