<?php

namespace App\Controller;

use MongoDB\Client;
use App\Entity\User;
use App\Security\Security;
use App\Security\UserValidator;
use App\Repository\UserRepository;
use App\Repository\AnimalRepository;

use App\MongoRepository\AnimalMongoRepository;
use App\Repository\ReviewVeterinaryRepository;



class DashboardController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'admin':
                        $this->admin();
                        break;
                    default:
                        throw new \Exception("Cette action n'existe pas : " . $_GET['action']);
                        break;
                }
            } else {
                throw new \Exception("Aucune action détectée");
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
                'pageTitle' => 'Erreur'
            ]);
        }
    }

    protected function admin(): void
    {
        if (!Security::isAdmin()) {
            throw new \Exception('Vous n\'avez pas les droits pour accéder à cette page');
        }
        // On récupère les animaux de la base de données mongo
        $animalMongoRepository = new AnimalMongoRepository();
        $animals = $animalMongoRepository->findAllAnimals();
        // On convertit le format Bson en tableau
        $animals = json_decode(json_encode($animals), true);
        // On trie le tableau par nombre de vues
        usort($animals, function ($a, $b) {
            return $b['viewsCounter'] <=> $a['viewsCounter'];
        });

        // On récupère les avis vétérinaires de la base de données par date de création plus récente
        $reviewVeterinaryRepository = new ReviewVeterinaryRepository();
        $reviewsVeterinary = $reviewVeterinaryRepository->findAll();
        foreach ($reviewsVeterinary as $reviewVeterinary) {
            $animalUuid = $reviewVeterinary->getAnimalUuid();
            $animalRepository = new AnimalRepository();
            $animalSql = $animalRepository->findOneByUuid($animalUuid);
            $userId = $reviewVeterinary->getUserId();
            $userRepository = new UserRepository();
            $user = $userRepository->findOneById($userId);
        }

        $this->render('dashboard/admin', [
            'pageTitle' => 'Administration',
            'animals' => $animals,
            'reviewsVeterinary' => $reviewsVeterinary,
            'animalSql' => $animalSql,
            'user' => $user
        ]);
    }
}
