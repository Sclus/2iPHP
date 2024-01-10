<?php

namespace App\Managers;

use App\Abstract\ItemBibliotheque;
use App\Interfaces\Recherchable;
use App\Models\Livre;
use App\Models\LivreSpecialise;

class BibliothequeManager implements Recherchable {


    /**
     * @var ItemBibliotheque[]
     */
    private array $livres; // Propriété pour stocker une collection de livres.

    // Constructeur de la classe Bibliothèque.
    public function __construct() {
        $this->livres = [];
    }

    public function ajouterLivre(Livre $livre): void
    {
        $this->livres[] = $livre;
    }

    // Méthode pour rechercher des livres dans la bibliothèque.
    //(L'implémentation de cette méthode est imposée par l'interface Recherchable)
    /**
     * @return Livre[]
     */
    #[\Override]
    public function rechercher($motCle): array
    {
        return array_filter($this->livres, function($livre) use ($motCle) {
            return str_contains(strtolower($livre->getTitre()), strtolower($motCle))
                || str_contains(strtolower($livre->getAuteur()), strtolower($motCle))
                || strval($livre->getAnneePublication()) === $motCle
                || ($livre instanceof LivreSpecialise && strtolower($livre->getDomaine()) === strtolower($motCle));
        });
    }
    /**
     * @return Livre[]
     */
    public function rechercherTitre(string $titre): array
    {
        return array_filter($this->livres, function($livre) use ($titre) {
            return str_contains(strtolower($livre->getTitre()), strtolower($titre));
        });
    }
    /**
     * @return Livre[]
     */
    public function rechercherAuteur(string $auteur): array
    {
        return array_filter($this->livres, function($livre) use ($auteur) {
            return str_contains(strtolower($livre->getAuteur()), strtolower($auteur));
        });
    }
    /**
     * @return Livre[]
     */
    public function rechercherAnnee(string $annee): array
    {
        return array_filter($this->livres, function($livre) use ($annee) {
            return strval($livre->getAnneePublication()) === $annee;
        });
    }
    /**
     * @return Livre[]
     */
    public function rechercherDomaine($domaine): array
    {
        return array_filter($this->livres, function($livre) use ($domaine) {
            return ($livre instanceof LivreSpecialise && strtolower($livre->getDomaine()) === strtolower($domaine));
        });
    }

    /**
     * @return Livre[]
     */
    public function getLivres(): array
    {
        return $this->livres;
    }

}