<?php require_once _ROOTPATH_ . '/templates/header.php';

use App\Security\Security; ?>
<?php if (Security::isVeterinary()) { ?>
    <script src="/assets/js/animal/reviewVeterinary.js" defer></script>
<?php } else if (Security::isEmployee()) { ?>
    <script src="/assets/js/animal/foodConsumption.js" defer></script>
<?php } ?>

<script src="/assets/js/animal/show.js" defer></script>
<?php foreach ($errors as $error) : ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
<?php endforeach; ?>


<main class="container">
    <h1 class="text-center p-2"><?= $pageTitle ?></h1>
    <div class="d-flex justify-content-center pb-3">
        <div class="card h-100 card-animal-show">
            <img class="rounded-top" src=<?= $animal->getImagePath() ?> alt="<?= $animal->getFirstName() ?>, <?= $animal->getRace() ?> ">
            <ul class="list-group list-group">
                <li class="list-group-item">Prénom: <?= ucfirst($animal->getFirstName()) ?></li>
                <li class="list-group-item">Race: <?= $animal->getRace() ?></li>
                <li class="list-group-item">Habitat: <?= $habitat ?></li>
                <?php if ($reviewVeterinary) { ?>
                    <li id="healthStatus" class="list-group-item">Etat: <?= $reviewVeterinary->getHealthStatus() ?></li>
                    <li class="list-group-item">Nourriture proposée: <?= $reviewVeterinary->getFood() ?></li>
                    <li class="list-group-item">Quantité: <?= $reviewVeterinary->getFoodQuantity() ?></li>
                    <li class="list-group-item">Date de passage: <?= $reviewVeterinary->getPassingDate()->format('d-m-Y') ?></li>
                    <li class="list-group-item">Détail de l'état de l'animal: <?= $reviewVeterinary->getHealthStatusDetails() ?></li>
                <?php } ?>
                <?php if (Security::isVeterinary()) {
                    if ($foodConsumption) {
                ?>
                        <li class="list-group-item">Nourriture donnée: <?= $foodConsumption->getFoodGiven() ?></li>
                        <li class="list-group-item">Quantité donnée: <?= $foodConsumption->getFoodQuantity() ?></li>
                        <li class="list-group-item">Dernière distribution: <?= $foodConsumption->getGiveAt()->format('d-m-Y H:i') ?></li>
                        <li class="list-group-item">Distribué par: <?= $foodConsumption->getUserLastName() . ' ' .  $foodConsumption->getUserFirstName() ?> </li>
                        <li class="list-group-item text-center"><a href="index.php?controller=animal&action=foodConsumptionList&uuid=<?= $animal->getUuid() ?>">Historique des distributions</a></li>
                <?php };
                } ?>
            </ul>
        </div>
    </div>
    <?php if (Security::isVeterinary()) { ?>
        <div class="d-flex justify-content-center">
            <button type="button" data-bs-toggle="modal" data-bs-target="#modalAddReviewVeterinary" class="btn btn-outline-primary"><i class="bi bi-clipboard-check fs-3"></i> Ajouter un avis vétérinaire</button>
        </div>
        <div>
            <!-- Modal -->
            <div class="modal fade" id="modalAddReviewVeterinary" tabindex="-1" aria-labelledby="addReviewVeterinaryLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title text-center fs-5" id="addReviewsVeterinary">Ajouter un avis vétérinaire ?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
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
                                <div class="mb-3 text-start">
                                    <label for="passing_date" class="form-label">Date de passage</label>
                                    <input type="date" class="form-control" id="passing_date" name="passing_date" value="<?= date('Y-m-d') ?>">
                                </div>
                                <div class="mb-3 text-start ">
                                    <label for="health_status_details" class="form-label">Détail de l'animal</label>
                                    <textarea class="form-control" rows='5' id="health_status_details" name="health_status_details"></textarea>
                                </div>
                                <div class="mb-3 text-start ">
                                    <label for="animalUuid" class="form-label"></label>
                                    <input type="hidden" class="form-control" id="animalUuid" name="animalUuid" value="<?= $animal->getUuid(); ?>">
                                </div>
                                <input type="hidden" class="form-control" id="userId" name="userId" value="<?= $_SESSION['user']['id']; ?>">
                                <div class="row d-flex justify-content-center pt-2">
                                    <input type="submit" name="addReviewVeterinary" id="addReviewVeterinary" class="btn btn-success" value="Ajouter" disabled>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } else if (Security::isEmployee()) { ?>
        <div class="d-flex justify-content-center">
            <button type="button" data-bs-toggle="modal" data-bs-target="#modalAddFoodConsumption" class="btn btn-outline-primary"><i class="bi bi-clipboard-check fs-3"></i> Ajouter une consommation de nourriture</button>
        </div>
        <div>
            <!-- Modal -->
            <div class="modal fade" id="modalAddFoodConsumption" tabindex="-1" aria-labelledby="addFoodConsumptionLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title text-center fs-5" id="addFoodConsumption">Ajouter une consommation de nourriture ?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <div class="mb-3 text-start">
                                    <label for="food_given" class="form-label">Nourriture</label>
                                    <input type="text" class="form-control" id="food_given" name="food_given">
                                </div>
                                <div class="mb-3 text-start">
                                    <label for="food_quantity" class="form-label">Quantité</label>
                                    <input type="text" class="form-control" id="food_quantity" name="food_quantity">
                                </div>
                                <div class="mb-3 text-start">
                                    <label for="give_at" class="form-label">Date de distribution</label>
                                    <input type="datetime-local" class="form-control" id="give_at" name="give_at" value="<?= date('Y-m-d\TH:i') ?>">
                                </div>
                                <div class="mb-3 text-start">
                                    <label for="animalUuid" class="form-label"></label>
                                    <input type="hidden" class="form-control" id="animalUuid" name="animalUuid" value="<?= $animal->getUuid(); ?>">
                                </div>
                                <input type="hidden" class="form-control" id="userId" name="userId" value="<?= $_SESSION['user']['id']; ?>">
                                <div class="row d-flex justify-content-center pt-2">
                                    <input type="submit" name="saveFoodConsumption" id="saveFoodConsumption" class="btn btn-success" value="Ajouter" disabled>
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