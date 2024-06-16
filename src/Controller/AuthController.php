<?php

namespace App\Controller;

use App\Repository\UserRepository;


class AuthController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'login':
                        $this->login();
                        break;
                    case 'logout':
                        $this->logout();
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

    protected function login()
    {
        $errors = [];

        if (isset($_POST['loginUser'])) {

            $userRepository = new UserRepository();

            $user = $userRepository->findOneByEmail($_POST['email']);

            if ($user && password_verify($_POST['password'], $user->getPassword())) {
                //Regénère l'identifiant de session pour éviter les attaques de fixation de session
                session_regenerate_id(true);
                //Génère un token pour éviter les attaques CSRF
                $_SESSION['token'] = bin2hex(random_bytes(32));
                $_SESSION['token-expire'] = time() + 3600;
                // Stocke les données de l'utilisateur dans la session
                $_SESSION['user'] = [
                    'id' => $user->getId(),
                    'email' => $user->getEmail(),
                    'first_name' => $user->getFirstName(),
                    'last_name' => $user->getLastName(),
                    'role' => $user->getRole(),
                ];
                header('location: index.php');
            } else throw new \Exception('Identifiants incorrects');
        }

        $this->render('auth/login', [
            'errors' => $errors,
            'pageTitle' => 'Connexion'
        ]);
    }

    protected function logout()
    {
        //Prévient les attaques de fixation de session
        session_regenerate_id(true);
        //Supprime les données de session du serveur
        session_destroy();
        //Supprime les données du tableau $_SESSION
        unset($_SESSION);
        //Redirige vers la page de connexion
        header('location: index.php?controller=auth&action=login');
    }
}
