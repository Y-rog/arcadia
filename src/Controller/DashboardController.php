<?php

namespace App\Controller;

use MongoDB\Client;
use App\Entity\User;
use App\Security\Security;
use App\Security\UserValidator;
use App\Repository\UserRepository;
use App\Repository\AnimalRepository;
use App\MongoRepository\AnimalMongoRepository;



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
        $animalMongoRepository = new AnimalMongoRepository();
        $animals = $animalMongoRepository->findAllAnimals();
        $animals = json_decode(json_encode($animals), true);
        print_r($animals);
        foreach ($animals as $key => $animal) {
            $animals[$key]['_id'] = $animal['_id'];
            $animals[$key]['uuid'] = $animal['uuid'];
            $animals[$key]['first_name'] = $animal['first_name'];
            $animals[$key]['race'] = $animal['race'];
            $animals[$key]['habitat_id'] = $animal['habitat_id'];
        }



        $this->render('dashboard/admin', [
            'pageTitle' => 'Administration',
            'animals' => $animals,
            'uuid' => $animal['uuid'],
            'firstName' => $animal['first_name'],
            'race' => $animal['race'],
        ]);
    }
}