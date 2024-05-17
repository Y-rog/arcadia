<?php

namespace App\Controller;

use App\Entity\User;
use Mailgun\Mailgun;
use App\Security\UserValidator;
use App\Repository\UserRepository;



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
                    $conf = require_once _ROOTPATH_ . '/mailgun_config.php';
                    $mgClient = Mailgun::create($conf['mailgun_api_key'], 'https://api.eu.mailgun.net');
                    $domain = $conf['mailgun_domain'];
                    $message = '<h1>Inscription Arcadia</h1>' .

                        '<p>Bonjour ' . $user->getFirstName() . ' ' . $user->getLastName() . ',</p>' .

                        '<p>Votre inscription a bien été prise en compte.</p>' .

                        '<p>Votre pseudo est : ' . $user->getEmail() . '.</p>' .

                        '<p>Merci de vous rapprocher de la direction pour obtenir votre mot de passe.</p>' .

                        '<p>A bientôt!</p>' .

                        '<p>José, directeur d\'Arcadia</p>';
                    $result = $mgClient->messages($message)->send($domain, array(
                        'from'    => $conf['jose_arcadia_email'],
                        'to'    =>  $user->getEmail(),
                        'subject' => 'Inscription Arcadia',
                        'html'    => $message,
                    ));
                    if ($result) {
                        header('Location: index.php?controller=user&action=register');
                    } else {
                        $this->render('errors/default', [
                            'error' => 'Erreur lors de l\'envoi du mail',
                            'pageTitle' => 'Erreur'
                        ]);
                    }
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
}
