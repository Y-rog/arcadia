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
use Throwable;

class AnimalController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'show':
                        $this->show();
                        break;
                    case 'add':
                        $this->add();
                        break;
                    case 'edit':
                        $this->edit();
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

    protected function add(): void
    {
        try {
            $errors = [];
            $animal = new Animal();
            // On récupère les habitats
            $habitatRepository = new HabitatRepository();
            $habitats = $habitatRepository->findAll();
            // Si le formulaire est soumis on ajoute l'animal
            if (isset($_POST['saveAnimal'])) {
                $animal->hydrate($_POST);
                $errors = (new AnimalValidator())->validateAnimal($animal);
                // Si le formulaire est valide on ajoute l'animal
                if (empty($errors)) {
                    $animalRepository = new AnimalRepository();
                    $animalRepository->insert($animal);
                    header('Location: index.php?controller=habitat&action=show&id=' . $animal->getHabitatId());
                } else {
                    throw new \Exception("Le formulaire contient des erreurs");
                }
            }
            $this->render('animal/add', [
                'animal' => $animal,
                'errors' => $errors,
                'pageTitle' => 'Ajouter un animal',
                'habitats' => $habitats,
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
            // On récupère l'animal
            $animalRepository = new AnimalRepository();
            $animal = $animalRepository->findOneById($_GET['id']);
            // On récupère les habitats
            $habitatRepository = new HabitatRepository();
            $habitats = $habitatRepository->findAll();
            // Si le formulaire est soumis on modifie l'animal
            if (isset($_POST['saveAnimal'])) {
                $animal->hydrate($_POST);
                $errors = (new AnimalValidator())->validateAnimal($animal);
                // Si le formulaire est valide on modifie l'animal
                if (empty($errors)) {
                    $animalRepository->insert($animal);
                    header('Location: index.php?controller=habitat&action=show&id=' . $animal->getHabitatId());
                } else {
                    throw new \Exception("Le formulaire contient des erreurs");
                }
            }
            $this->render('animal/edit', [
                'animal' => $animal,
                'errors' => $errors,
                'pageTitle' => 'Modifier un animal',
                'habitats' => $habitats,
            ]);
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
            $errors = [];
            // On récupère l'animal
            $animalRepository = new AnimalRepository();
            $animal = $animalRepository->findOneById($_GET['id']);
            if (!$animal) {
                throw new \Exception("Cet animal n'existe pas");
            }
            // On récupère le dernier avis vétérinaire de l'animal
            $reviewVeterinaryRepository = new ReviewVeterinaryRepository();
            $reviewVeterinary = $reviewVeterinaryRepository->findLastReviewVeterinaryByAnimal($animal->getId());
            // Si le formulaire d'ajout est soumis on ajoute un avis vétérinaire
            if (isset($_POST['addReviewVeterinary'])) {
                // On hydrate l'objet
                $reviewVeterinary = new ReviewVeterinary();
                $reviewVeterinary->hydrate($_POST);

                $errors = (new ReviewVeterinaryValidator())->validateReviewVeterinary($reviewVeterinary);

                if (empty($errors)) {
                    $reviewVeterinaryRepository = new ReviewVeterinaryRepository();
                    $reviewVeterinaryRepository->insert($reviewVeterinary);
                    var_dump($reviewVeterinary);
                    header('Location: index.php?controller=habitat&action=show&id=' . $animal->getHabitatId());
                    exit();
                } else throw new \Exception("Le formulaire contient des erreurs");
            }
            //Si le formualire de suppression est soumis on supprime l'animal
            if (isset($_POST['deleteAnimal'])) {
                $animalRepository->delete($animal);
                header('Location: index.php?controller=habitat&action=show&id=' . $animal->getHabitatId());
                exit();
            }
            $this->render('animal/show', [
                'animal' => $animal,
                'pageTitle' => 'Détail de l\'animal',
                'habitat' => (new HabitatRepository())->findOneById($animal->getHabitatId())->getName(),
                'reviewVeterinary' => $reviewVeterinary,
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
