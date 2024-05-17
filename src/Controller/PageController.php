<?php

namespace App\Controller;

use App\Entity\Zoo;

use App\Entity\Review;
use App\Repository\ZooRepository;
use App\Security\ReviewValidator;
use App\Security\ContactValidator;
use App\Repository\ReviewRepository;
use Mailgun\Mailgun;

class PageController extends Controller
{
    public function route(): void
    {
        try {
            //on verrifie si le controller est défini dans l'url
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'home':
                        $this->home();
                        break;
                    case 'contact':
                        $this->contact();
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

    protected function home(): void
    {

        try {
            $errors = [];
            $reviewRepository = new ReviewRepository();
            $reviews = $reviewRepository->findReviewHomePage();
            $review = new Review();
            $zoo = new Zoo();
            $zooRepository = new ZooRepository();
            $zoo = $zooRepository->findZoo();
            if (isset($_POST['addReview'])) {
                $review->hydrate($_POST);
                $reviewValidator = new ReviewValidator();
                $errors = $reviewValidator->validateReview($review);
                if (empty($errors)) {
                    $reviewRepository = new ReviewRepository();
                    $reviewRepository->insert($review);
                    header('Location: index.php?controller=page&action=home');
                } else throw new \Exception("Le formulaire contient des erreurs");
            }
            $this->render('page/home', [
                'reviews' => $reviews,
                'review' => $review,
                'pageTitle' => 'Accueil',
                'zoo' => $zoo,
            ]);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
                'pageTitle' => 'Erreur',
            ]);
        }
    }

    protected function contact(): void
    {
        $errors = [];
        $contact = [];
        if (isset($_POST['sendMail'])) {
            $contact = $_POST;
            $contactValidator = new ContactValidator();
            $errors = $contactValidator->validateContact($contact);
            if (empty($errors)) {
                //envoi du mail avec mailgun
                $conf = require_once _ROOTPATH_ . '/mailgun_config.php';
                $mgClient = Mailgun::create($conf['mailgun_api_key'], 'https://api.eu.mailgun.net');
                $domain = $conf['mailgun_domain'];
                $message = '<h1>Message envoyé depuis la page Contact d\'Arcadia</h1>' .

                    '<p>Email de l\'expéditeur : ' . $contact['email'] . '</p>' .

                    '<p>Titre du message : ' . $contact['title'] . '</p>' .

                    '<p>Message : ' . $contact['message'] . '</p>';

                $result = $mgClient->messages($message)->send($domain, array(
                    'from'    => $contact['email'],
                    'to'    =>  $conf['jose_arcadia_email'],
                    'subject' => $contact['title'],
                    'html'    => $message,
                ));

                if ($result) {
                    header('Location: index.php?controller=page&action=home');
                } else throw new \Exception("L'envoi du mail a échoué");
            } else $this->render('page/contact', [
                'errors' => $errors,
                'contact' => $contact,
                'pageTitle' => 'Contact',
            ]);
        }
        $this->render('page/contact', [
            'errors' => $errors,
            'contact' => $contact,
            'pageTitle' => 'Contact',
        ]);
    }
}
