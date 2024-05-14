<?php

namespace App\Controller;

use Throwable;
use App\Entity\Animal;
use App\Entity\Habitat;
use App\Tools\FileTools;
use App\Entity\FoodConsumption;
use App\Entity\ReviewVeterinary;
use App\Security\AnimalValidator;
use App\Repository\UserRepository;
use App\Repository\AnimalRepository;
use App\Repository\HabitatRepository;
use App\Security\FoodConsumptionValidator;
use App\Security\ReviewVeterinaryValidator;
use App\Repository\FoodConsumptionRepository;
use App\MongoRepository\AnimalMongoRepository;
use App\Repository\ReviewVeterinaryRepository;

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
                    case 'foodConsumptionList':
                        $this->foodConsumptionList();
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
                $file = $_FILES['image'];
                // On vérifie si une image a été uploadée
                if ($file['error'] === 0) {
                    // On upload l'image avec Cloudinary
                    $image = FileTools::uploadImage($file, null);
                    // On récupère le public id de l'image
                    $publicId = $image['public_id'];
                } else throw new \Exception("Aucune image n'a été uploadée");
                // On hydrate l'objet
                $animal->hydrate($_POST);
                $animal->setImage($publicId);
                $animalValidator = new AnimalValidator();
                $errors = $animalValidator->validateAnimal($animal);
                // Si le formulaire est valide on ajoute l'animal
                if (empty($errors)) {
                    // On ajoute l'animal dans la base de données SQL
                    $animalRepository = new AnimalRepository();
                    $animalRepository->insert($animal);
                    // On ajoute l'animal dans la base de données MongoDB
                    $animalMongoRepository = new AnimalMongoRepository();
                    $animalMongoRepository->insert($animal);
                    header('Location: index.php?controller=habitat&action=show&id=' . $animal->getHabitatId());
                } else {
                    $this->render('animal/add', [
                        'animal' => $animal,
                        'errors' => $errors,
                        'pageTitle' => 'Ajouter un animal',
                        'habitats' => $habitats,
                    ]);
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
            // On récupère l'ancien nom de l'image
            $oldFileName = $animal->getImage();
            // Si le formulaire est soumis on modifie l'animal
            if (isset($_POST['saveAnimal'])) {
                $file = $_FILES['image'];
                // On vérifie si une image a été chargéee
                if ($file['error'] === 0) {
                    // On upload l'image avec Cloudinary et on supprime l'ancienne image
                    $image = FileTools::uploadImage($file, $oldFileName);
                    $publicId = $image['public_id'];
                } else throw new \Exception("Aucune image n'a été chargée");
                // On hydrate l'objet   
                $animal->hydrate($_POST);
                $animal->setImage($publicId);
                // On valide l'objet
                $animalVadlidator = new AnimalValidator();
                $errors = $animalVadlidator->validateAnimal($animal);
                // Si le formulaire est valide on modifie l'animal
                if (empty($errors)) {
                    // On modifie l'animal dans la base de données SQL
                    $animalRepository = new AnimalRepository();
                    $animalRepository->insert($animal);
                    // On modifie l'animal dans la base de données MongoDB
                    $animalMongoRepository = new AnimalMongoRepository();
                    $animalMongoRepository->update($animal);
                    header('Location: index.php?controller=habitat&action=show&id=' . $animal->getHabitatId());
                } else {
                    $this->render('animal/edit', [
                        'animal' => $animal,
                        'errors' => $errors,
                        'pageTitle' => 'Ajouter un animal',
                        'habitats' => $habitats,
                    ]);
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
            $animal = $animalRepository->findOneByUuid($_GET['uuid']);
            if (!$animal) {
                throw new \Exception("Cet animal n'existe pas");
            }
            //On récupère le nom de l'habitat de l'animal
            $habitatRepository = new HabitatRepository();
            $habitat = $habitatRepository->findOneById($animal->getHabitatId());
            $habitat = $habitat->getName();
            // On récupère le dernier avis vétérinaire de l'animal
            $reviewVeterinaryRepository = new ReviewVeterinaryRepository();
            $reviewVeterinary = $reviewVeterinaryRepository->findLastReviewVeterinaryByAnimal($animal->getUuid());
            // On récupère les 10derniéres consommations de nourriture de l'animal
            $foodConsumptionRepository = new FoodConsumptionRepository();
            $foodConsumption = $foodConsumptionRepository->findLastFoodConsumptionByAnimal($animal->getUuid());
            // Si le formulaire d'ajout d'avis vétérinaire est soumis on ajoute un avis vétérinaire
            if (isset($_POST['addReviewVeterinary'])) {
                // On hydrate l'objet
                $reviewVeterinary = new ReviewVeterinary();
                $reviewVeterinary->hydrate($_POST);
                $reviewVeterinaryValidator = new ReviewVeterinaryValidator();
                $errors = $reviewVeterinaryValidator->validateReviewVeterinary($reviewVeterinary);

                if (empty($errors)) {
                    $reviewVeterinaryRepository = new ReviewVeterinaryRepository();
                    $reviewVeterinaryRepository->insert($reviewVeterinary);
                    header('Location: index.php?controller=habitat&action=show&id=' . $animal->getHabitatId());
                    exit();
                } else {
                    throw new \Exception("Le formulaire contient des erreurs");
                }
            }
            // Si le formulaire de consommation de nourriture est soumis on ajoute une consommation de nourriture
            if (isset($_POST['saveFoodConsumption'])) {
                $foodConsumption = new FoodConsumption();
                $foodConsumption->hydrate($_POST);
                $foodConsumptionValidator = new FoodConsumptionValidator();
                $errors = $foodConsumptionValidator->validateFoodConsumption($foodConsumption);
                if (empty($errors)) {
                    $foodConsumptionRepository = new FoodConsumptionRepository();
                    $foodConsumptionRepository->insert($foodConsumption);
                    header('Location: index.php?controller=animal&action=show&uuid=' . $animal->getUuid());
                    exit();
                } else {
                    throw new \Exception("Le formulaire contient des erreurs");
                }
            }
            //Si le formualire de suppression est soumis on supprime l'animal
            if (isset($_POST['deleteAnimal'])) {
                //On supprime l'image de l'animal
                FileTools::deleteImage($animal->getImage());
                // On supprime l'animal dans la base de données SQL
                $animalRepository = new AnimalRepository();
                $animalRepository->delete($animal);
                // On supprime l'animal dans la base de données MongoDB
                $animalMongoRepository = new AnimalMongoRepository();
                $animalMongoRepository->delete($animal);
                header('Location: index.php?controller=habitat&action=show&id=' . $animal->getHabitatId());
                exit();
            }

            //On incrémente le compteur de vues
            $animalMongoRepository = new AnimalMongoRepository();
            $datas = $animalMongoRepository->findAllAnimals();
            $data = $animalMongoRepository->findOneAnimalByUuid($_GET['uuid']);
            $data = json_decode(json_encode($animalMongoRepository), true);
            foreach ($datas as $key => $data) {
                $datas[$key]['_id'] = $data['_id'];
                $datas[$key]['uuid'] = $data['uuid'];
                $datas[$key]['first_name'] = $data['first_name'];
                $datas[$key]['race'] = $data['race'];
                $datas[$key]['habitat_id'] = $data['habitat_id'];
                $datas[$key]['viewsCounter'] = $data['viewsCounter'];
            }
            $viewsCounter = $data['viewsCounter'];
            $viewsCounter++;
            $animalMongoRepository->updateViewsCounter($data);

            $this->render('animal/show', [
                'animal' => $animal,
                'pageTitle' => 'Détail de l\'animal',
                'habitat' => $habitat,
                'reviewVeterinary' => $reviewVeterinary,
                'errors' => $errors,
                'foodConsumption' => $foodConsumption,

            ]);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
                'pageTitle' => 'Erreur',
            ]);
        }
    }

    protected function foodConsumptionList()
    {
        try {
            $errors = [];
            // On récupère l'animal
            $animalRepository = new AnimalRepository();
            $animal = $animalRepository->findOneByUuid($_GET['uuid']);
            if (!$animal) {
                throw new \Exception("Cet animal n'existe pas");
            }
            // On récupère les consommations de nourriture de l'animal
            $foodConsumptionRepository = new FoodConsumptionRepository();
            $foodConsumptions = $foodConsumptionRepository->findAllByAnimal($animal->getUuid());
            $this->render('animal/foodConsumptionList', [
                'animal' => $animal,
                'pageTitle' => 'Historique des consommations de nourriture',
                'foodConsumptions' => $foodConsumptions,
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
