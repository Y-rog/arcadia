<?php

namespace App\Controller;

class Controller
{
    public function route(): void
    {
        try {
            //on verrifie si le controller est défini dans l'url
            if (isset($_GET['controller'])) {
                switch ($_GET['controller']) {
                    case 'animal':
                        $controller = new AnimalController();
                        $controller->route();
                        break;
                    case 'auth':
                        $controller = new AuthController();
                        $controller->route();
                        break;
                    case 'dashboard':
                        $controller = new DashboardController();
                        $controller->route();
                        break;
                    case 'habitat':
                        $controller = new HabitatController();
                        $controller->route();
                        break;
                    case 'page':
                        $controller = new PageController();
                        $controller->route();
                        break;
                    case 'review':
                        $controller = new ReviewController();
                        $controller->route();
                        break;
                    case 'service':
                        $controller = new ServiceController();
                        $controller->route();
                        break;
                    case 'user':
                        $controller = new UserController();
                        $controller->route();
                        break;
                    default:
                        throw new \Exception("Le controller n'existe pas");
                        break;
                }
            } else {
                // charger la page d'accueil
                $pageController = new PageController();
                $pageController->home();
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
                'pageTitle' => 'Erreur',
            ]);
        }
    }

    // méthode pour afficher le rendu
    protected function render(string $path, array $params = []): void
    {
        $filePath = _ROOTPATH_ . '/templates/' . $path . '.php';


        try {
            if (!file_exists($filePath)) {
                throw new \Exception('Le fichier ' . $filePath . ' n\'existe pas');
            } else {
                extract($params);
                require_once $filePath;
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage(),
                'pageTitle' => 'Erreur',
            ]);
        }
    }
}
