<?php

use App\Security\Security;

require_once _ROOTPATH_ . '/templates/header.php'; ?>
<script src="/assets/js/habitat/form.js" defer></script>
<?php foreach ($errors as $error) : ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
<?php endforeach; ?>

<main class="container">
    <?php if (Security::isAdmin()) { ?>
        <div class="text-center pb-3">
            <h1><?= $pageTitle ?></h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-10 ">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3 text-start">
                        <label for="name">Nom de l'habitat</label>
                        <input type="text" class='form-control' id="name" name="name" value="">
                        <div class='invalid-feedback'>
                            Le nom de l'habitat est requis.
                        </div>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="description">Description de l'habitat</label>
                        <textarea class='form-control' id="description" name="description" value=""></textarea>
                        <div class='invalid-feedback'>
                            La description de l'habitat est requise.
                        </div>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="image">Image de l'habitat</label>
                        <input type="file" class="form-control" id="image" name="image" value="">
                        <div class='invalid-feedback'>
                            L'image de l'habitat est requise.
                        </div>
                    </div>
                    <div class="row justify-content-center pt-2">
                        <input type="submit" id="saveHabitat" name="saveHabitat" class="btn btn-success" value="Ajouter" disabled>
                    </div>
                </form>
            </div>

            <div class="container pt-5">
                <a href="index.php?controller=habitat&action=list"><i class="bi bi-skip-backward"></i> Retour</a>
            </div>
        </div>
    <?php } else { ?>
        <div class="alert alert-danger">
            <span>Vous n'avez pas les droits pour ajouter un habitat</span>
        </div>
    <?php } ?>
</main>
<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>