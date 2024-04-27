<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;
use App\Security\UserValidator;



class UserController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'register':
                        $this->register();
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
                'pageTitle' => 'Erreur'
            ]);
        }
    }

    protected function register(): void
    {
        try {
            $errors = [];
            $user = new User();

            if (isset($_POST['saveUser'])) {
                $user->hydrate($_POST);
                $userValidator = new UserValidator();
                $errors = $userValidator->validateUser($user);
                if (empty($errors)) {
                    $userRepository = new UserRepository();
                    $userRepository->insert($user);
                    header('Location: index.php?controller=user&action=register');
                } else { // si il y a des erreurs
                    $this->render('user/register', [
                        'errors' => $errors,
                        'user' => $user,
                        'pageTitle' => 'Inscription'
                    ]);
                }
            }
            $this->render('user/register', [
                'errors' => $errors,
                'user' => $user,
                'pageTitle' => 'Inscription'
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
            $userRepository = new UserRepository();
            $userRepository->delete($_GET['id']);
            header('Location: index.php?controller=user&action=login');
            exit();
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
                'pageTitle' => 'Erreur',
            ]);
        }
    }
}
