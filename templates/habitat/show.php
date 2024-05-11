<?php

use App\Security\Security;

require_once _ROOTPATH_ . '/templates/header.php'; ?>
<script src="/assets/js/animal/list.js" defer></script>
<?php if (Security::isVeterinary()) { ?>
    <script src="/assets/js/habitat/commentHabitat.js" defer></script>
<?php } ?>
<main class="container">
    <h1 class="text-center"><?= ucfirst($habitat->getName()) ?></h1>
    <div class="row">
        <div><img class="rounded" width="100%" height="auto" src='<?= $habitat->getImagePath() ?>' alt="<?= $habitat->getName() ?>"></div>
        <p><?= $habitat->getDescription() ?></p>
    </div>
    <?php if (Security::isVeterinary()) { ?>
        <div class="d-flex justify-content-center mb-3">
            <button type="button" data-bs-toggle="modal" data-bs-target="#modalAddCommentHabitat" class="btn btn-outline-primary"> Ajouter un commentaire</button>
        </div>
        <div>
            <!-- Modal -->
            <div class="modal fade" id="modalAddCommentHabitat" tabindex="-1" aria-labelledby="modalAddCommentHabitatLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title text-center fs-5" id="addComment">Ajouter un avis vétérinaire ?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <div class=" mb-3">
                                    <div class="mb-3 text-start">
                                        <label for="content" class="form-label">Commentaire</label>
                                        <textarea class="form-control" id="content" name="content" rows="5"></textarea>
                                    </div>
                                    <div class="mb-3 text-start">
                                        <label for="passing_date" class="form-label">Date de passage</label>
                                        <input type="date" class="form-control" id="passing_date" name="passing_date" value="<?= date('Y-m-d') ?>">
                                    </div>
                                    <input type="hidden" class="form-control" id="habitat_id" name="habitat_id" value="<?= $habitat->getId(); ?>">
                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?= $_SESSION['user']['id']; ?>">
                                    <div class="row d-flex justify-content-center pt-2">
                                        <input type="submit" name="saveCommentHabitat" id="saveCommentHabitat" class="btn btn-success" value="Ajouter" disabled>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
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
                </div>
            </div>
        </div>
    <?php } ?>
    </div>
    <div class="text-center">
        <h3>Liste des animaux:</h3>
    </div>
    <?php if (Security::isAdmin()) { ?>
        <div class="text-center pb-3">
            <a href="index.php?controller=animal&action=add"><button class="btn btn-outline-primary">
                    Ajouter un animal
                </button></a>
        </div>
    <?php } ?>
    <div class="row justify-content-center">
        <?php foreach ($animals as $animal) : ?>
            <div class="col d-flex justify-content-center p-3">
                <a href="index.php?controller=animal&action=show&uuid=<?= $animal->getUuid() ?>">
                    <div class="card card-animal-list">
                        <img class="rounded-top" src=<?= $animal->getImagePath() ?> alt="<?= $animal->getFirstName() ?>, <?= $animal->getRace() ?> ">
                        <ul class="list-group list-group">
                            <li class="list-group-item" hidden>Id: <?= $animal->getUuid() ?></li>
                            <li class="list-group-item">Prénom: <?= ucwords($animal->getFirstname()) ?></li>
                            <li class="list-group-item">Race: <?= $animal->getRace() ?></li>
                            <li class="list-group-item">Habitat: <?= $habitat->getName() ?></li>
                            <li class="healthStatus list-group-item">Etat: <?= $animal->getHealthStatus() ?></li>
                        </ul>
                    </div>
                </a>
            </div>

        <?php endforeach; ?>
    </div>
    <a href="index.php?controller=habitat&action=list"><i class="bi bi-skip-backward"></i> Retour</a>
</main>
<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>