<?php

namespace App\Controller;

use App\Repository\ReviewRepository;
use App\Entity\Review;
use App\Security\ReviewValidator;

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
}
