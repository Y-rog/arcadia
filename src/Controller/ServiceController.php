<?php

namespace App\Controller;

use App\Entity\Service;
use App\Security\Security;
use App\Security\ServiceValidator;
use App\Repository\ServiceRepository;


class ServiceController extends Controller
{
    public function route(): void
    {
        try {
            //on verrifie si le controller est défini dans l'url
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'list':
                        $this->list();
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

    protected function list(): void
    {
        $errors = [];
        //on instancie la classe ServiceRepository
        $serviceRepository = new ServiceRepository();
        //on récupère les services
        $services = $serviceRepository->findAll();
        if (isset($_POST['deleteService'])) {
            //on instancie la classe Service
            $service = new Service();
            //on hydrate l'objet
            $service->setId($_POST['id']);
            //on instancie la classe ServiceRepository
            $serviceRepository = new ServiceRepository();
            //on supprime le service
            $serviceRepository->delete($service);
            //on redirige vers la liste des services
            header('Location: /index.php?controller=service&action=list');
            exit;
        }
        //on affiche la vue
        $this->render('service/list', [
            'services' => $services,
            'pageTitle' => 'Liste des services',
            'errors' => $errors
        ]);
    }


    protected function add(): void
    {
        try {
            $errors = [];
            //on vérifie si l'utilisateur est admin
            if (!Security::isAdmin()) {
                throw new \Exception('Vous n\'avez pas les droits pour accéder à cette page');
            } else {
                //On récupère l'id de l'utilisateur connecté
                $service = new Service();
                $service->setUserId(Security::getCurrentUserId());
                //on vérifie si le formulaire a été soumis
                if (isset($_POST['saveService'])) {
                    //on instancie la classe Service
                    $service = new Service();
                    //on hydrate l'objet
                    $service->hydrate($_POST);
                    //on instancie la classe ServiceValidator
                    $serviceValidator = new ServiceValidator();
                    //on vérifie les données
                    $errors = $serviceValidator->validateService($service);
                    //si il n'y a pas d'erreurs on ajoute le service
                    if (empty($errors)) {
                        //on instancie la classe ServiceRepository
                        $serviceRepository = new ServiceRepository();
                        //on ajoute le service
                        $serviceRepository->register($service);
                        //on redirige vers la liste des services
                        header('Location: /index.php?controller=service&action=list');
                        exit;
                    } else {
                        //on affiche la vue
                        $this->render('service/add', [
                            'errors' => $errors,
                            'pageTitle' => 'Ajouter un service',
                            'service' => $service
                        ]);
                    }
                } else {
                    //on affiche la vue
                    $this->render('service/add', [
                        'pageTitle' => 'Ajouter un service',
                        'errors' => $errors,
                        'service' => $service
                    ]);
                }
            }
            //on attrape les exceptions
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
                'pageTitle' => 'Erreur'
            ]);
        }
    }

    protected function edit()
    {
        try {
            if (Security::isAdmin()  || Security::isEmployee()) {
                $errors = [];
                //on instancie la classe Service
                $service = new Service();
                //on instancie la classe ServiceRepository
                $serviceRepository = new ServiceRepository();
                //on hydrate l'objet
                $service = $serviceRepository->findOneById($_GET['id']);
                //On récupère l'id de l'utilisateur connecté
                $service->setUserId(Security::getCurrentUserId());
                //on vérifie si le formulaire a été soumis
                if (isset($_POST['saveService'])) {
                    //on hydrate l'objet
                    $service->hydrate($_POST);
                    //on instancie la classe ServiceValidator
                    $serviceValidator = new ServiceValidator();
                    //on vérifie les données
                    $errors = $serviceValidator->validateService($service);
                    //si il n'y a pas d'erreurs on ajoute le service
                    if (empty($errors)) {
                        //on instancie la classe ServiceRepository
                        $serviceRepository = new ServiceRepository();
                        //on ajoute le service
                        $serviceRepository->register($service);
                        //on redirige vers la liste des services
                        header('Location: /index.php?controller=service&action=list');
                        exit;
                    } else {
                        //on affiche la vue
                        $this->render('service/edit', [
                            'errors' => $errors,
                            'pageTitle' => 'Modifier un service',
                            'service' => $service,
                        ]);
                    }
                } else {
                    //on affiche la vue
                    $this->render('service/edit', [
                        'pageTitle' => 'Modifier un service',
                        'service' => $service,
                        'errors' => $errors,
                    ]);
                }
            } else {
                throw new \Exception('Vous n\'avez pas les droits pour accéder à cette page');
            }
        }
        //on attrape les exceptions
        catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
                'pageTitle' => 'Erreur'
            ]);
        }
    }
}
