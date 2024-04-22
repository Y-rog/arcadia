<?php

namespace App\Controller;

use App\Entity\Habitat;
use APP\Security\Security;
use App\Security\HabitatValidator;
use App\Repository\AnimalRepository;
use App\Repository\HabitatRepository;

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
                        $this->delete();
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

                $this->render('habitat/show', [
                    'pageTitle' => 'Habitat ' . $habitat->getName(),
                    'habitat' => $habitat
                ]);
            } else {
                throw new \Exception("L'id est manquant en paramètre d'url");
            }
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

            if (isset($_POST['saveHabitat'])) {
                $habitat->hydrate($_POST);
                $habitatValidator = new HabitatValidator();
                $errors = $habitatValidator->validateHabitat($habitat);
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

    protected function delete(): void
    {
        if (isset($_POST['deleteHabitat'])) {
            $habitatRepository = new HabitatRepository();
            $habitat = $habitatRepository->findOneById($_POST['id']);
            $habitatRepository->delete($habitat);
            header('Location: index.php?controller=habitat&action=list');
        }
    }

    protected function edit(): void
    {
        try {
            $errors = [];
            $habitatRepository = new HabitatRepository();
            $habitat = $habitatRepository->findOneById($_GET['id']);

            if (isset($_POST['saveHabitat'])) {
                $habitat->hydrate($_POST);
                $habitatValidator = new HabitatValidator();
                $errors = $habitatValidator->validateHabitat($habitat);
                if (empty($errors)) {
                    $habitatRepository->update($habitat);
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
