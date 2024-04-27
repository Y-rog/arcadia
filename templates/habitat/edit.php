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
            <h1> <?= $pageTitle ?>: <?= ucfirst($habitat->getName()) ?></h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-8 ">
                <form method="POST" enctype="multipart/form-data">
                    <div>
                        <input type="hidden" name="id" value="<?= $habitat->getId() ?>">
                    </div>
                    <div class="mb-3 text-start">
                        <label for="name" class="form-label">Nom de l'habitat</label>
                        <input type="text" value="<?= $habitat->getName(); ?>" class='form-control' id="name" name="name">
                    </div>
                    <div class="mb-3 text-start">
                        <label for="description" class="form-label">Description de l'habitat</label>
                        <input type="text" value="<?= $habitat->getDescription(); ?>" class='form-control' id="description" name="description">
                    </div>
                    <div class="mb-3 text-start">
                        <label for="image" class="form-label">Image de l'habitat</label>
                        <input type="file" class="form-control" value="<?= $habitat->getImage(); ?>" id="image" name="image">
                    </div>
                    <div class="row justify-content-center pt-2">
                        <input type="submit" id="saveHabitat" name="saveHabitat" class="btn btn-success" value="Modifier" disabled>
                    </div>
                </form>
            </div>

            <div class="container pt-5">
                <a href="index.php?controller=habitat&action=list"><i class="bi bi-skip-backward"></i> Retour</a>
            </div>
        </div>
    <?php } else { ?>
        <div class="alert alert-danger">
            <span>Vous n'avez pas les droits pour modifier un habitat</span>
        </div>
    <?php } ?>
</main>
<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>