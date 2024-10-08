<?php

namespace App\Controller;

use App\Repository\ReviewRepository;
use App\Entity\Review;


class ReviewController extends Controller
{
    public function route(): void
    {
        try {
            //on verrifie si le controller est défini dans l'url
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'list':
                        $this->isValidated();
                        $this->updateFavorite();
                        $this->list();
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

        try {
            //on instancie la classe ReviewRepository
            $reviewRepository = new ReviewRepository();
            //on récupère le nombre total d'avis
            $count = $reviewRepository->count();
            //on définit le nombre d'avis par page
            $perPage =  5;
            //on détermine le nombre de pages en arrondissant au supérieur
            $pages = ceil($count / $perPage);
            /*On vérifie si la page demandée existe et on la récupère et on conditionne pour éviter les injections SQL*/
            if (isset($_GET['page']) && $_GET['page'] > 0  && $_GET['page'] <= $pages) {
                $currentPage = (int) $_GET['page'];
            } else {
                $currentPage = 1;
            }
            //on récupère les articles par pages
            $reviews = $reviewRepository->showPageReviews($currentPage, $perPage);
            //on vérifie si le bouton supprimer a été cliqué
            if (isset($_POST['deleteReview'])) {
                // On vérifie si le jeton de session est valide
                if ($_SESSION['token'] !== $_POST['token']) {
                    throw new \Exception("Jeton de session invalide");
                }
                if ($_SESSION['token-expire'] < time()) {
                    throw new \Exception("Le jeton de session a expiré");
                }
                //on instancie la classe ReviewRepository
                $reviewRepository = new ReviewRepository();
                //on récupère l'avis par son id
                $review = $reviewRepository->findOneById($_POST['id']);
                //on supprime l'avis
                $reviewRepository->delete($review);
                //on redirige vers la page list
                header('location: index.php?controller=review&action=list&page=' . $currentPage);
                exit();
            }
            //on affiche la vue
            $this->render('review/list', [
                'reviews' => $reviews,
                'currentPage' => $currentPage,
                'pages' => $pages,
            ]);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
                'pageTitle' => 'Erreur',
            ]);
        }
    }

    protected function isValidated()
    {
        //on vérifie si le bouton valider a été cliqué
        if (isset($_POST['validateReview'])) {
            // On vérifie si le jeton de session est valide
            if ($_SESSION['token'] !== $_POST['token']) {
                throw new \Exception("Jeton de session invalide");
            }
            if ($_SESSION['token-expire'] < time()) {
                throw new \Exception("Le jeton de session a expiré");
            }
            //on instancie la classe ReviewRepository
            $reviewRepository = new ReviewRepository();
            //on récupère l'avis par son id
            $review = $reviewRepository->findOneById($_POST['id']);
            //on valide l'avis
            $reviewRepository->validateReview($review);
            //On insert l'utilisateur qui a validé l'avis
            $reviewRepository->insertUserId($review, $_POST['user_id']);
            //on redirige vers la page list
            $currentPage = (int) $_GET['page'];
            header("'location: index.php?controller=review&action=list&page='$currentPage");
        } else if (isset($_POST['unvalidateReview'])) {
            // On vérifie si le jeton de session est valide
            if ($_SESSION['token'] !== $_POST['token']) {
                throw new \Exception("Jeton de session invalide");
            }
            if ($_SESSION['token-expire'] < time()) {
                throw new \Exception("Le jeton de session a expiré");
            }
            $reviewRepository = new ReviewRepository();
            $review = $reviewRepository->findOneById($_POST['id']);
            $reviewRepository->unvalidate($review);
            $reviewRepository->insertUserId($review, $_POST['user_id']);
            $currentPage = (int) $_GET['page'];
            header("'location: index.php?controller=review&action=list&page='$currentPage");
        }
    }

    protected function updateFavorite()
    {
        if (isset($_POST['favoriteReview'])) {
            // On vérifie si le jeton de session est valide
            if ($_SESSION['token'] !== $_POST['token']) {
                throw new \Exception("Jeton de session invalide");
            }
            if ($_SESSION['token-expire'] < time()) {
                throw new \Exception("Le jeton de session a expiré");
            }
            $reviewRepository = new ReviewRepository();
            $review = $reviewRepository->findOneById($_POST['id']);
            $reviewRepository->favorite($review);
            $reviewRepository->insertUserId($review, $_POST['user_id']);
            $currentPage = (int) $_GET['page'];
            header("'location: index.php?controller=review&action=list&page='$currentPage");
        } else if (isset($_POST['unfavoriteReview'])) {
            // On vérifie si le jeton de session est valide
            if ($_SESSION['token'] !== $_POST['token']) {
                throw new \Exception("Jeton de session invalide");
            }
            if ($_SESSION['token-expire'] < time()) {
                throw new \Exception("Le jeton de session a expiré");
            }
            $reviewRepository = new ReviewRepository();
            $review = $reviewRepository->findOneById($_POST['id']);
            $reviewRepository->unfavorite($review);
            $reviewRepository->insertUserId($review, $_POST['user_id']);
            $currentPage = (int) $_GET['page'];
            header("'location: index.php?controller=review&action=list&page='$currentPage");
        }
    }
}
