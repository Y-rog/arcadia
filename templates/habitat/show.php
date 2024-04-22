<?php

use App\Security\Security;

require_once _ROOTPATH_ . '/templates/header.php'; ?>
<main class="container">
    <div class="row">
        <img class="rounded" width="100%" height="auto" aria-hidden="true" src='<?= $habitat->getImagePath() ?>' alt="<?= $habitat->getName() ?>">
        <p><?= $habitat->getDescription() ?></p>
        <?php if (Security::isAdmin()) { ?>
            <div class="d-flex justify-content-evenly pb-3">
                <a href="index.php?controller=habitat&action=edit&id=<?= $habitat->getId() ?>"><button class="btn btn-secondary">Modifier</button></a>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteHabitat">Supprimer</button>
            </div>
            <div class="modal fade" id="deleteHabitat" tabindex="-1" aria-labelledby="addReviewLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content text-center">
                        <div class="modal-body">
                            <p>Etes-vous sûr de vouloir supprimer cet habitat?</p>
                            <form method="POST" class="pb-2">
                                <input type="hidden" name="id" value="<?= $habitat->getId() ?>">
                                <input type="submit" class="btn btn-danger" value="Supprimer" name="deleteHabitat">
                            </form>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="text-center">
        <h3>Liste des animaux:</h3>
    </div>
    <div class="container">
        <a href="index.php?controller=habitat&action=list"><i class="bi bi-skip-backward"></i> Retour</a>
    </div>
</main>
<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>