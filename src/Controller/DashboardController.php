<?php

namespace App\Controller;

use App\Entity\Zoo;
use MongoDB\Client;
use App\Entity\User;
use App\Security\Security;
use App\Security\ZooValidator;
use App\Security\UserValidator;

use App\Repository\ZooRepository;
use App\Repository\UserRepository;
use App\Repository\AnimalRepository;
use App\Repository\HabitatRepository;
use App\Repository\CommentHabitatRepository;
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
                    case 'animalViewList':
                        $this->animalViewList();
                        break;
                    case 'commentHabitatList':
                        $this->commentHabitatList();
                        break;
                    case 'reviewVeterinaryList':
                        $this->reviewVeterinaryList();
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

        // On récupère les horaires du zoo
        $zooRepository = new ZooRepository();
        $zoo = $zooRepository->findZoo();
        //On récupère les commmentaires vétérinaires par habitat
        $commentHabitatRepository = new CommentHabitatRepository();
        $commentsHabitat = $commentHabitatRepository->findLastCommentsHabitat();
        foreach ($commentsHabitat as $commentHabitat) {
            $habitatId = $commentHabitat->getHabitatId();
            $habitatRepository = new HabitatRepository();
            $habitat = $habitatRepository->findOneById($habitatId);
            $userId = $commentHabitat->getUserId();
            $userRepository = new UserRepository();
            $user = $userRepository->findOneById($userId);
        }
        // On récupère les avis vétérinaires de la base de données par date de création plus récente
        $reviewVeterinaryRepository = new ReviewVeterinaryRepository();
        $reviewsVeterinary = $reviewVeterinaryRepository->findLastReviewsVeterinary();
        foreach ($reviewsVeterinary as $reviewVeterinary) {
            $animalUuid = $reviewVeterinary->getAnimalUuid();
            $animalRepository = new AnimalRepository();
            $animalSql = $animalRepository->findOneByUuid($animalUuid);
            $userId = $reviewVeterinary->getUserId();
            $userRepository = new UserRepository();
            $user = $userRepository->findOneById($userId);
        }
        // On récupère les animaux de la base de données mongo
        try {
            if (!isset($_ENV['MONGODB_URI'])) {
                throw new \Exception('La variable d\'environnement MONGODB_URI n\'est pas définie');
            } else {
                $client = new Client($_ENV['MONGODB_URI']);
            }
            $animalMongoRepository = new AnimalMongoRepository($client);
            $animals = $animalMongoRepository->findAllAnimals();
            // On convertit le format Bson en tableau
            $animals = json_decode(json_encode($animals), true);
            // On trie le tableau par nombre de vues
            usort($animals, function ($a, $b) {
                return $b['viewsCounter'] <=> $a['viewsCounter'];
            });
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
                'pageTitle' => 'Erreur'
            ]);
        }

        // On met à jour les horaires du zoo
        try {
            if (isset($_POST['editSchedules'])) {
                $zoo = new Zoo();
                $zoo->hydrate($_POST);
                $zooRepository = new ZooRepository();
                $zooValidator = new ZooValidator();
                $errors = $zooValidator->validateZoo($zoo);
                if (empty($errors)) {
                    $zooRepository->updateSchedules($zoo);
                    header('Location: index.php?controller=page&action=home');
                } else throw new \Exception('Les horaires sont obligatoires');
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
                'pageTitle' => 'Erreur'
            ]);
        }


        $this->render('dashboard/admin', [
            'pageTitle' => 'Administration',
            'animals' => $animals,
            'reviewsVeterinary' => $reviewsVeterinary,
            'animalSql' => $animalSql,
            'user' => $user,
            'commentsHabitat' => $commentsHabitat,
            'habitat' => $habitat,
            'zoo' => $zoo
        ]);
    }

    protected function animalViewList(): void
    {
        if (!Security::isAdmin()) {
            throw new \Exception('Vous n\'avez pas les droits pour accéder à cette page');
        }

        try {
            if (!isset($_ENV['MONGODB_URI'])) {
                throw new \Exception('La variable d\'environnement MONGODB_URI n\'est pas définie');
            } else {
                $client = new Client($_ENV['MONGODB_URI']);
            }
            $animalMongoRepository = new AnimalMongoRepository($client);
            $animals = $animalMongoRepository->findAllAnimals();
            $animals = json_decode(json_encode($animals), true);
            usort($animals, function ($a, $b) {
                return $b['viewsCounter'] <=> $a['viewsCounter'];
            });
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
                'pageTitle' => 'Erreur'
            ]);
        }

        $this->render('dashboard/animalViewList', [
            'pageTitle' => 'Liste des animaux les plus vus',
            'animals' => $animals
        ]);
    }

    protected function reviewVeterinaryList(): void
    {
        if (!Security::isAdmin()) {
            throw new \Exception('Vous n\'avez pas les droits pour accéder à cette page');
        }

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
        $this->render('dashboard/reviewVeterinaryList', [
            'pageTitle' => 'Liste des avis vétérinaires',
            'reviewsVeterinary' => $reviewsVeterinary,
            'animalSql' => $animalSql,
            'user' => $user
        ]);
    }

    protected function  commentHabitatList(): void
    {
        if (!Security::isAdmin()) {
            throw new \Exception('Vous n\'avez pas les droits pour accéder à cette page');
        }

        $commentHabitatRepository = new CommentHabitatRepository();
        $commentsHabitat = $commentHabitatRepository->findAll();
        foreach ($commentsHabitat as $commentHabitat) {
            $habitatId = $commentHabitat->getHabitatId();
            $habitatRepository = new HabitatRepository();
            $habitat = $habitatRepository->findOneById($habitatId);
            $userId = $commentHabitat->getUserId();
            $userRepository = new UserRepository();
            $user = $userRepository->findOneById($userId);
        }
        $this->render('dashboard/commentHabitatList', [
            'pageTitle' => 'Liste des commentaires vétérinaires par habitat',
            'commentsHabitat' => $commentsHabitat,
            'habitat' => $habitat,
            'user' => $user
        ]);
    }
}
