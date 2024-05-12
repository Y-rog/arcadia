<?php

use App\Security\Security;

require_once _ROOTPATH_ . '/templates/header.php'; ?>
<script src="/assets/js/service/form.js" defer></script>
<?php foreach ($errors as $error) : ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
<?php endforeach; ?>

<main class="container">
    <?php if (Security::isAdmin() || Security::isEmployee()) { ?>
        <div class="text-center pb-3">
            <h1><?= $pageTitle ?></h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-8 ">
                <form method="POST">
                    <input type="hidden" name="id" value="<?= $service->getId() ?>">
                    <input type="hidden" name="user_id" value="<?= $service->getUserId() ?>">
                    <div class=" mb-3 text-start">
                        <label for="title">Titre du service</label>
                        <input type="text" class='form-control' id="title" name="title" value="<?= $service->getTitle() ?>">
                        <div class='invalid-feedback'>
                            Le titre du service est requis.
                        </div>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="description">Description du service</label>
                        <textarea class='form-control' id="description" name="description" rows="3"><?= $service->getDescription() ?></textarea>
                        <div class='invalid-feedback'>
                            La description du service est requise.
                        </div>
                    </div>
                    <div class="row justify-content-center pt-2">
                        <input type="submit" id="saveService" name="saveService" class="btn btn-success" value="Modifier" disabled>
                    </div>
                </form>
            </div>

            <div class="container pt-5">
                <a href="index.php?controller=habitat&action=list"><i class="bi bi-skip-backward"></i> Retour</a>
            </div>
        </div>
    <?php } ?>
</main>
<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>