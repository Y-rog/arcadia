<?php require_once _ROOTPATH_ . '/templates/header.php'; ?>
<main class="container">
    <div class="text-center pb-3">
        <h1>Tableau de bord</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-2 ">
            <div class="row justify-content-center">
                <a href="index.php?controller=user&action=register" class="btn btn-outline-primary">Gestion des utilisateurs</a>
            </div>
        </div>
    </div>

    <?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>