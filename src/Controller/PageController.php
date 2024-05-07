<?php

namespace App\Controller;

use App\Entity\Review;
use App\Security\ReviewValidator;
use App\Security\ContactValidator;
use App\Repository\ReviewRepository;

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
                $to = 'jose.arcadia2024@gmail.com';
                $subject = $contact['title'];
                $headers = 'From: ' . $contact['email'];
                $headers .= 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                $headers .= 'Reply-To: ' . $contact['email'] . "\r\n";
                $message = '<h1>Message envoyé depuis la page Contact d\'Arcadia</h1>' .

                    '<p>Email de l\'expéditeur : ' . $contact['email'] . '</p>' .

                    '<p>Titre du message : ' . $contact['title'] . '</p>' .

                    '<p>Message : ' . $contact['message'] . '</p>';

                if (mail($to, $subject, $message, $headers)) {
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
