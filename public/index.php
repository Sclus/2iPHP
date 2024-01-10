<?php

require __DIR__ . '/../vendor/autoload.php';


use App\Abstract\ItemBibliotheque;
use App\Exceptions\LivreException;
use App\Helpers\UIHelper;
use App\Managers\BibliothequeManager;
use App\Models\Livre;
use App\Models\LivreSpecialise;
function readLinePrompt($prompt) : false|string{
    echo $prompt;
    return readline();
}

$bibliotheque = new BibliothequeManager();

while (true) {
    UIHelper::afficherMenu();
    $choix = readline("Choisissez une option : ");

    switch ($choix) {
        case "1":
            try {
                $titre = readLinePrompt("Entrez le titre : ");
                $auteur = readLinePrompt("Entrez l'auteur : ");
                $anneePublicationStr = readLinePrompt("Entrez l'année de publication : ");
                $domaine = readLinePrompt("Entrez le domaine (ou laissez vide) : ");

                $anneePublication = filter_var($anneePublicationStr, FILTER_VALIDATE_INT, [
                    "options" => [
                        "min_range" => 1000,
                        "max_range" => 9999
                    ]
                ]);

                if ($anneePublication === false) {
                    throw new LivreException("L'année de publication doit être un nombre à 4 chiffres.");
                }

                if (empty($domaine)) {
                    $livre = new Livre($titre, $auteur, $anneePublication);
                } else {
                    $livre = new LivreSpecialise($titre, $auteur, $anneePublication, $domaine);
                }

                $bibliotheque->ajouterLivre($livre);
                echo "Livre ajouté avec succès.\n";

            } catch (LivreException $e) {
                echo "Erreur lors de l'ajout du livre : " . $e->getMessage() . "\n";
            }
            break;


        case "2":
            echo "\nListe des livres :\n";
            UIHelper::afficherLivresSousFormeDeTableau($bibliotheque->getLivres());
            break;

        case "3":
            $titre = readLinePrompt("Entrez le titre à rechercher : ");
            $resultats = $bibliotheque->rechercherTitre($titre);

            echo "\nRésultats de la recherche par titre :\n";
            UIHelper::afficherLivresSousFormeDeTableau($resultats);
            break;

        case "4":
            $domaineRecherche = readLinePrompt("Entrez le domaine à rechercher : ");
            $resultats = $bibliotheque->rechercherDomaine($domaineRecherche);

            if (count($resultats) > 0) {
                echo "\nRésultats de la recherche pour le domaine '$domaineRecherche' :\n";
                UIHelper::afficherLivresSousFormeDeTableau($resultats);
            } else {
                echo "\nAucun livre trouvé pour le domaine '$domaineRecherche'.\n";
            }
            break;
        case "5":
            $domaineRecherche = readLinePrompt("Entrez l'auteur à rechercher : ");
            $resultats = $bibliotheque->rechercherAuteur($domaineRecherche);

            if (count($resultats) > 0) {
                echo "\nRésultats de la recherche pour l'auteur' '$domaineRecherche' :\n";
                UIHelper::afficherLivresSousFormeDeTableau($resultats);
            } else {
                echo "\nAucun livre trouvé pour le domaine '$domaineRecherche'.\n";
            }
            break;
        case "6":
            $motCle = readLinePrompt("Entrez le mot clé à rechercher : ");

            $resultats = $bibliotheque->rechercher($motCle);

            if (count($resultats) > 0) {
                echo "\nRésultats de la recherche pour le mot clé '$motCle' :\n";
                UIHelper::afficherLivresSousFormeDeTableau($resultats);
            } else {
                echo "\nAucun livre trouvé pour le mot clé '$motCle'.\n";
            }
            break;

        case "7":
            exit("\033[1;32mFin du programme.\n\033[0m");

        default:
            echo "\033[1;31mOption non valide. Veuillez réessayer.\n\033[0m";
            break;
    }
}
