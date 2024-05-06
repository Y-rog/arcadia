<?php

use App\Security\Security; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="/assets/css/index.css">
</head>

<body>

    <header class="pb-2 px-4">
        <nav class="navbar navbar-expand-lg  border-bottom">
            <div class="container-fluid">
                <a href="/" class="d-flex justify-content-start col-4 ">
                    <img width="200" src="../assets/img/logo-svg.svg" alt="logo Arcadia" class="img-fluid">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav col-lg-6 justify-content-lg-center">
                        <a class="nav-link" href="index.php?controller=page&action=home">Accueil</a>
                        <a class="nav-link" href="index.php?controller=habitat&action=list">Habitats</a>
                        <a class="nav-link" href="index.php?controller=service&action=list">Services</a>
                        <a class="nav-link" href="#">Contact</a>
                        <?php if (Security::isAdmin()) { ?>
                            <a class="nav-link" href="index.php?controller=dashboard&action=admin"><i class="d-flex bi  bi-speedometer2 fs-4"></i></a>
                        <?php } ?>
                    </div>
                    <div class="navbar-nav col-lg-6 justify-content-end">
                        <?php if (Security::isLogged()) { ?>
                            <a class=" nav-link" href=" /index.php?controller=auth&action=logout">Déconnexion</a>
                        <?php } else { ?>
                            <a class="nav-link" href="/index.php?controller=auth&action=login">Espace administration <i class="bi bi-person-fill-lock"></i></a>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </nav>
    </header>