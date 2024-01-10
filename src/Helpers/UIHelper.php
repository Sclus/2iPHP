<?php

namespace App\Helpers;

use App\Models\Livre;
use App\Models\LivreSpecialise;

class UIHelper {
    public static function afficherDomaines($domainesDisponibles): void
    {
        foreach ($domainesDisponibles as $index => $domaine) {
            echo ($index + 1) . ". $domaine\n";
        }
    }


    /**
     * @param Livre[] $livres
     */
    public static function afficherLivresSousFormeDeTableau(array $livres): void
    {
        echo "\033[1;34m"; // Couleur bleue
        echo str_pad("Titre", 40) . str_pad("Auteur", 30) . str_pad("Année", 10) . str_pad("Domaine", 20) . "\n";
        echo "\033[0m"; // Réinitialiser le style

        foreach ($livres as $livre) {
            echo str_pad($livre->getTitre(), 40);
            echo str_pad($livre->getAuteur(), 30);
            echo str_pad($livre->getAnneePublication(), 10);
            $domaine = ($livre instanceof LivreSpecialise) ? $livre->getDomaine() : "Sans domaine";
            echo str_pad($domaine, 20);
            echo "\n";
        }
    }

    public static function afficherMenu(): void
    {
        echo "\033[1;33m\n"; // Couleur jaune
        echo "1. Ajouter un livre\n";
        echo "2. Lister tous les livres\n";
        echo "3. Rechercher un livre par titre\n";
        echo "4. Rechercher un livre par domaine\n";
        echo "5. Rechercher un livre par auteur\n";
        echo "6. Rechercher un livre par mot clé\n";
        echo "7. Quitter\n";
        echo "\033[0m"; // Réinitialiser le style
        echo "Choisissez une option : ";
    }
}
