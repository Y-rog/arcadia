<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Habitat;
use App\Entity\ReviewVeterinary;
use App\Security\AnimalValidator;
use App\Repository\UserRepository;
use App\Repository\AnimalRepository;
use App\Repository\HabitatRepository;
use App\Security\ReviewVeterinaryValidator;
use App\Repository\ReviewVeterinaryRepository;




class AnimalController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'show':
                        $this->addVeterinaryReview();
                        $this->show();
                        break;
                    case 'add':
                        $this->add();
                        break;
                    case 'edit':
                        $this->edit();
                        break;
                    case 'delete':
                        $this->delete();
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
                'pageTitle' => 'Erreur',
            ]);
        }
    }

    protected function show()
    {
        try {
            $animalRepository = new AnimalRepository();
            $animal = $animalRepository->findOneById($_GET['id']);
            $this->render('animal/show', [
                'animal' => $animal,
                'pageTitle' => 'Détail de l\'animal',
                'habitat' => (new HabitatRepository())->findOneById($animal->getHabitatId())->getName(),
            ]);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
                'pageTitle' => 'Erreur',
            ]);
        }
    }

    protected function add(): void
    {
        try {
            $errors = [];
            $animal = new Animal();

            if (isset($_POST['saveAnimal'])) {

                $animal->hydrate($_POST);

                $errors = (new AnimalValidator())->validateAnimal($animal);

                if (empty($errors)) {
                    $animalRepository = new AnimalRepository();

                    $animalRepository->insert($animal);
                    header('Location: index.php?controller=animal&action=add');
                }
            }

            $this->render('animal/add', [
                'animal' => $animal,
                'errors' => $errors,
                'pageTitle' => 'Ajouter un animal',
                'habitats' => (new HabitatRepository())->findAll(),
            ]);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
                'pageTitle' => 'Erreur',
            ]);
        }
    }

    protected function edit(): void
    {
        try {
            $errors = [];
            $animalRepository = new AnimalRepository();
            $animal = $animalRepository->findOneById($_GET['id']);

            if (isset($_POST['saveAnimal'])) {

                $animal->hydrate($_POST);

                $errors = (new AnimalValidator())->validateAnimal($animal);

                if (empty($errors)) {
                    $animalRepository->insert($animal);
                    header('Location: index.php?controller=habitat&action=edit&id=' . $animal->getId());
                }
            }

            $this->render('animal/edit', [
                'animal' => $animal,
                'errors' => $errors,
                'pageTitle' => 'Modifier un animal',
                'habitats' => (new HabitatRepository())->findAll(),
            ]);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
                'pageTitle' => 'Erreur',
            ]);
        }
    }

    protected function delete(): void
    {
        try {
            $errors = [];
            $animalRepository = new AnimalRepository();
            $animal = $animalRepository->findOneById($_GET['id']);

            if (isset($_POST['delete'])) {
                $animalRepository->delete($animal->getId());
                header('Location: index.php?controller=habitat&action=list');
            }

            $this->render('animal/delete', [
                'habitatName' => (new HabitatRepository())->findOneById($animal->getHabitatId())->getName(),
            ]);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
                'pageTitle' => 'Erreur',
            ]);
        }
    }

    protected function addVeterinaryReview()
    {
        try {
            $errors = [];
            $animalRepository = new AnimalRepository();
            $animal = $animalRepository->findOneById($_GET['id']);

            if (isset($_POST['addReviewVeterinary'])) {
                $reviewVeterinary = new ReviewVeterinary();
                $reviewVeterinary->hydrate($_POST);

                $errors = (new ReviewVeterinaryValidator())->validateReviewVeterinary($reviewVeterinary);

                if (empty($errors)) {
                    $reviewVeterinaryRepository = new ReviewVeterinaryRepository();
                    $reviewVeterinaryRepository->insert($reviewVeterinary);
                    header('Location: index.php?controller=habitat&action=show&id=' . $animal->getHabitatId());
                    exit();
                } else throw new \Exception("Le formulaire contient des erreurs");
            }

            $this->render('animal/show', [
                'animal' => $animal,
                'pageTitle' => 'Détail de l\'animal',
                'habitat' => (new HabitatRepository())->findOneById($animal->getHabitatId())->getName(),
                'errors' => $errors,
            ]);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
                'pageTitle' => 'Erreur',
            ]);
        }
    }
}
