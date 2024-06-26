<?php

namespace App\Controller;

use App\Entity\Habitat;
use App\Tools\FileTools;
use APP\Security\Security;
use Cloudinary\Cloudinary;
use App\Entity\CommentHabitat;
use App\Entity\ReviewVeterinary;
use App\Security\HabitatValidator;
use App\Repository\AnimalRepository;
use App\Repository\HabitatRepository;
use App\Security\CommentHabitatValidator;
use App\Repository\CommentHabitatRepository;
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
            $errors = [];
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
            } else {
                throw new \Exception("Cet habitat n'existe pas");
            }
            if (isset($_POST['saveCommentHabitat'])) {
                // On vérifie si le jeton de session est valide
                if ($_SESSION['token'] !== $_POST['token']) {
                    throw new \Exception("Jeton de session invalide");
                }
                if ($_SESSION['token-expire'] < time()) {
                    throw new \Exception("Le jeton de session a expiré");
                }
                $commentHabitat = new CommentHabitat();
                $commentHabitat->hydrate($_POST);
                $commentHabitatValidator = new CommentHabitatValidator();
                $errors = $commentHabitatValidator->validateCommentHabitat($commentHabitat);
                if (empty($errors)) {
                    $commentHabitatRepository = new CommentHabitatRepository();
                    $commentHabitatRepository->insert($commentHabitat);
                    header('Location: index.php?controller=habitat&action=show&id=' . $habitat->getId());
                } else throw new \Exception("Le formulaire contient des erreurs");
            }
            if (isset($_POST['deleteHabitat'])) {
                // On vérifie si le jeton de session est valide
                if ($_SESSION['token'] !== $_POST['token']) {
                    throw new \Exception("Jeton de session invalide");
                }
                if ($_SESSION['token-expire'] < time()) {
                    throw new \Exception("Le jeton de session a expiré");
                }
                //On supprime l'image de l'habitat
                FileTools::deleteImage($habitat->getImage());
                //On supprime l'habitat
                $habitatRepository = new HabitatRepository();
                $habitatRepository->delete($habitat);
                header('Location: index.php?controller=habitat&action=list');
                exit;
            }
            $this->render('habitat/show', [
                'pageTitle' => 'Habitat ' . $habitat->getName(),
                'habitat' => $habitat,
                'animals' => $animals,

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
                // On vérifie si le jeton de session est valide
                if ($_SESSION['token'] !== $_POST['token']) {
                    throw new \Exception("Jeton de session invalide");
                }
                if ($_SESSION['token-expire'] < time()) {
                    throw new \Exception("Le jeton de session a expiré");
                }
                // On vérifie si une image a été uploadée
                $file = $_FILES['image'];
                if ($file['error'] === 0) {
                    //On upload l'image avec Cloudinary
                    $image = FileTools::uploadImage($file, null);
                    //On récupère le public id l'image
                    $publicId = $image['public_id'];
                } else throw new \Exception("Aucune image n'a été uploadée");
                //On hydrate l'objet habitat
                $habitat->setName($_POST['name']);
                $habitat->setDescription($_POST['description']);
                $habitat->setImage($publicId);
                //On valide l'objet habitat
                $habitatValidator = new HabitatValidator();
                $errors = $habitatValidator->validateHabitat($habitat);
                //Si le formulaire est valide on ajoute l'habitat
                if (empty($errors)) {
                    $habitatRepository = new HabitatRepository();
                    $habitatRepository->insert($habitat);
                    header('Location: index.php?controller=habitat&action=list');
                } else {
                    $this->render('habitat/add', [
                        'pageTitle' => 'Ajouter un habitat',
                        'habitat' => $habitat,
                        'errors' => $errors
                    ]);
                }
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
                // On vérifie si le jeton de session est valide
                if ($_SESSION['token'] !== $_POST['token']) {
                    throw new \Exception("Jeton de session invalide");
                }
                if ($_SESSION['token-expire'] < time()) {
                    throw new \Exception("Le jeton de session a expiré");
                }
                $file = $_FILES['image'];
                // On vérifie si une image a été chargéee
                if ($file['error'] === 0) {
                    //On récupère l'ancien publicId de l'image
                    $oldPublicId = $habitat->getImage();
                    //On upload l'image avec Cloudinary et on supprime l'ancienne image
                    $file = FileTools::uploadImage($file, $oldPublicId);
                    //On récupère le publicId de la nouvelle image
                    $publicId = $file['public_id'];
                } else throw new \Exception("Aucune image n'a été uploadée");
                //On hydrate l'objet habitat
                $habitat->hydrate($_POST);
                $habitat->setImage($publicId);
                //On valide l'objet habitat
                $habitatValidator = new HabitatValidator();
                $errors = $habitatValidator->validateHabitat($habitat);
                //Si le formulaire est valide on ajoute l'habitat
                //Si le formulaire est valide on modifie l'habitat
                if (empty($errors)) {
                    $habitatRepository = new HabitatRepository();
                    $habitatRepository->edit($habitat);
                    header('Location: index.php?controller=habitat&action=list');
                } else {
                    $this->render('habitat/edit', [
                        'pageTitle' => 'Modifier un habitat',
                        'habitat' => $habitat,
                        'errors' => $errors
                    ]);
                }
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
