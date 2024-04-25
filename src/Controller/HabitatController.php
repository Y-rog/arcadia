<?php

namespace App\Controller;

use App\Entity\Habitat;
use APP\Security\Security;
use App\Entity\ReviewVeterinary;
use App\Security\HabitatValidator;
use App\Repository\AnimalRepository;
use App\Repository\HabitatRepository;
use App\Repository\ReviewVeterinaryRepository;

class HabitatController extends Controller
{
    public function route(): void
    {
        try {
            //on verrifie si le controller est défini dans l'url
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'add':
                        // on appelle la méthode add
                        $this->add();
                        break;
                    case 'show':
                        //on appelle la méthode show
                        $this->show();
                        break;
                    case 'list':
                        // on appelle la méthode list
                        $this->list();
                        break;
                    case 'edit':
                        // on appelle la méthode edit
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

    protected function show(): void
    {
        try {
            if (isset($_GET['id'])) {
                //Récupérer l'id de l'habitat
                $id = (int)$_GET['id'];
                //Charger l'habitat par un appel au repository
                $habitatRepository = new HabitatRepository();
                $habitat = $habitatRepository->findOneById($id);
                if (!$habitat) {
                    throw new \Exception("Cet habitat n'existe pas");
                }
                //Charger les animaux par habitat par un appel au repository
                $animalRepository = new AnimalRepository();
                $animals = $animalRepository->findAllByHabitat($id);
                //Charger le dernier avis vétérinaire par animal par un appel au repository
                foreach ($animals as $animal) {
                    $reviewVeterinaryRepository = new ReviewVeterinaryRepository();
                    $reviewVeterinary = $reviewVeterinaryRepository->findLastReviewVeterinaryByAnimal($animal->getId());
                    //Si pas d'avis vétérinaire, on crée un avis vide
                    if (!$reviewVeterinary) {
                        $reviewVeterinary = new ReviewVeterinary();
                    }
                }
                //Si le formulaire de suppression est soumis
                if (isset($_POST['deleteHabitat'])) {
                    $habitatRepository = new HabitatRepository();
                    $habitat = $habitatRepository->findOneById($_POST['id']);
                    $habitatRepository->delete($habitat);
                    header('Location: index.php?controller=habitat&action=list');
                }
            } else {
                throw new \Exception("Cet habitat n'existe pas");
            }
            //Afficher la vue show
            $this->render('habitat/show', [
                'pageTitle' => 'Habitat ' . $habitat->getName(),
                'habitat' => $habitat,
                'animals' => $animals,
                'reviewVeterinary' => $reviewVeterinary

            ]);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
                'pageTitle' => 'Erreur',
            ]);
        }
    }

    protected function list(): void
    {
        try {
            //Charger la liste des habitats par un appel au repository
            $habitatRepository = new HabitatRepository();
            $habitats = $habitatRepository->findAll();

            $this->render('habitat/list', [
                'pageTitle' => 'Liste des habitats',
                'habitats' => $habitats,
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
            $habitat = new Habitat();
            //Si le formulaire est soumis on ajoute un habitat
            if (isset($_POST['saveHabitat'])) {
                $habitat->hydrate($_POST);
                $habitatValidator = new HabitatValidator();
                $errors = $habitatValidator->validateHabitat($habitat);
                //Si le formulaire est valide on ajoute l'habitat
                if (empty($errors)) {
                    $habitatRepository = new HabitatRepository();
                    $habitatRepository->insert($habitat);
                    header('Location: index.php?controller=habitat&action=list');
                } else throw new \Exception("Le formulaire contient des erreurs");
            } else {
                $this->render('habitat/add', [
                    'pageTitle' => 'Ajouter un habitat',
                    'habitat' => $habitat,
                    'errors' => $errors
                ]);
            }
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
            $habitatRepository = new HabitatRepository();
            $habitat = $habitatRepository->findOneById($_GET['id']);
            //Si le formulaire est soumis on modifie l'habitat
            if (isset($_POST['saveHabitat'])) {
                $habitat->hydrate($_POST);
                $habitatValidator = new HabitatValidator();
                $errors = $habitatValidator->validateHabitat($habitat);
                //Si le formulaire est valide on modifie l'habitat
                if (empty($errors)) {
                    $habitatRepository->edit($habitat);
                    header('Location: index.php?controller=habitat&action=list');
                } else throw new \Exception("Le formulaire contient des erreurs");
            } else {
                $this->render('habitat/edit', [
                    'pageTitle' => 'Modifier un habitat',
                    'habitat' => $habitat,
                    'errors' => $errors
                ]);
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
                'pageTitle' => 'Erreur',
            ]);
        }
    }
}
