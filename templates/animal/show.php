<?php require_once _ROOTPATH_ . '/templates/header.php';

use App\Security\Security; ?>
<script src="/assets/js/animal/reviewVeterinary.js" defer></script>

<main class="container">
    <h1 class="text-center p-2"><?= ucwords($animal->getFirstname()) ?></h1>
    <div class="d-flex justify-content-center pb-3">
        <div class="card h-100 card-animal-show">
            <img class="rounded-top" src=<?= $animal->getImagePath() ?> alt="<?= $animal->getFirstName() ?>, <?= $animal->getRace() ?> ">
            <ul class="list-group list-group">
                <li class="list-group-item">Race: <?= $animal->getRace() ?></li>
                <li class="list-group-item">Habitat: <?= $habitat ?></li>
            </ul>
        </div>
    </div>
    <?php if (Security::isVeterinary()) { ?>
        <div class="d-flex justify-content-center">
            <button data-bs-toggle="modal" href="#addReviewVeterinary" class="btn btn-outline-primary"><i class="bi bi-clipboard-check fs-3"></i> Ajouter un avis vétérinaire</button>
        </div>
        <div>
            <!-- Modal -->
            <div class="modal fade" id="addReviewVeterinary" tabindex="-1" aria-labelledby="addReviewVeterinaryLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title text-center fs-5" id="addReviewVeterinary">Ajouter un avis sur </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <div class=" mb-3">
                                    <div class=" mb-3 text-start">
                                        <label for="health_status" class="form-label">Etat</label>
                                        <select class="form-select" id="health_status" name="health_status">
                                            <option value="Bon">Bon</option>
                                            <option value="Moyen">Moyen</option>
                                            <option value="Mauvais">Mauvais</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 text-start ">
                                        <label for="food" class="form-label">Nourriture proposée</label>
                                        <input type="text" class="form-control" id="food" name="food">
                                    </div>
                                    <div class="mb-3 text-start ">
                                        <label for="food_quantity" class="form-label">Quantité</label>
                                        <input type="text" class="form-control" id="food_quantity" name="food_quantity">
                                    </div>
                                    <div class="mb-3 text-start ">
                                        <label for="created-at" class="form-label"></label>
                                        <input type="hidden" class="form-control" id="created_at" name="created_at">
                                    </div>
                                    <div class="mb-3 text-start ">
                                        <label for="health_status_details" class="form-label">Détail de l'animal</label>
                                        <textarea class="form-control" id="health_status_details" name="health_status_details"></textarea>
                                    </div>
                                    <div class="mb-3 text-start ">
                                        <label for="animalId" class="form-label"></label>
                                        <input type="hidden" class="form-control" id="animalId" name="animalId" value="<?= $animal->getId(); ?>">
                                    </div>
                                    <div class="mb-3 text-start ">
                                        <label for="userId" class="form-label"></label>
                                        <input type="hidden" class="form-control" id="userId" name="userId" value="<?= $_SESSION['user']['id']; ?>">
                                    </div>
                                    <div class="row d-flex justify-content-center pt-2">
                                        <input type="submit" name="addReviewVeterinary" id="addReviewVeterinary" class="btn btn-primary" value="Envoyer">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
        <?php if (Security::isAdmin()) { ?>
            <div class="d-flex justify-content-evenly pb-3">
                <a href="index.php?controller=animal&action=edit&id=<?= $animal->getId() ?>"><button class="btn btn-secondary">Modifier</button></a>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAnimal">Supprimer</button>
            </div>
            <div class="modal fade" id="deleteAnimal" tabindex="-1" aria-labelledby="addReviewLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content text-center">
                        <div class="modal-body">
                            <p>Etes-vous sûr de vouloir supprimer cet animal?</p>
                            <form method="POST" class="pb-2">
                                <input type="hidden" name="id" value="<?= $animal->getId() ?>">
                                <input type="submit" class="btn btn-danger" value="Supprimer" name="deleteAnimal">
                            </form>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="container pt-5">
            <a href="index.php?controller=habitat&action=list"><i class="bi bi-skip-backward"></i> Retour</a>
        </div>
</main>

<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>