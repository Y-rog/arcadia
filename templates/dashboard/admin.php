<?php require_once _ROOTPATH_ . '/templates/header.php';

use App\Security\Security;

if (Security::isAdmin()) { ?>
    <script src="/assets/js/dashboard/schedules.js" defer></script>
    <script src="/node_modules/chart.js/dist/chart.umd.js" defer></script>
    <script src="/assets/js/dashboard/animalViews.js" defer></script>
    <script src="/assets/js/dashboard/reviewVeterinary.js" defer></script>
    <main class="container">
        <div class="text-center pb-3">
            <h1>Tableau de bord</h1>
        </div>
        <div class="d-flex row justify-content-center flex-wrap">
            <div class=" col border border-light-subtle rounded mx-3 flex-wrap">
                <h6 class="text-secondary">Gestion des utilisateurs</h6>
                <div class=" pb-5 d-flex flex-wrap">
                    <a href="index.php?controller=user&action=register" class="btn btn-outline-primary">Ajouter un utilisateur</a>
                </div>
            </div>
            <div class="col  border border-light-subtle rounded mx-3 flex-wrap">
                <h6 class="text-secondary">Gestion des horaires</h6>
                <div class="pb-5 d-flex flex-wrap">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalEditSchedules" class="btn btn-outline-primary">Modifier les horaires</button>
                </div>
                <div class="modal" id="modalEditSchedules" tabindex="-1" aria-labelledby="modalEditSchedulesLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title text-center fs-5" id="modalEditSchedulesLabel">Modifier les horaires</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($zoo->getId()); ?>">
                                    <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id']; ?>">
                                    <div class=" mb-3 text-start">
                                        <label for="schedules" class="form-label">Horaires</label>
                                        <input type="text" class="form-control" id="schedules" name="schedules" value="<?= htmlspecialchars($zoo->getSchedules()) ?>">
                                    </div>
                                    <div class="row d-flex justify-content-center pt-2">
                                        <input type="submit" name="editSchedules" id="editSchedules" class="btn btn-success" value="Modifier" disabled>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex row justify-content-center flex-wrap">
                <div class="col border border-light-subtle rounded mt-3 mx-3">
                    <h6 class="text-secondary">Gestion des services</h6>
                    <div class=" pb-5 d-flex flex-wrap">
                        <div class="p-2"><a href="index.php?controller=service&action=add" class="col btn btn-outline-primary">Ajouter un service</a></div>
                        <div class="p-2"><a href="index.php?controller=service&action=list" class="col btn btn-outline-secondary">Voir les services</a></div>
                    </div>
                </div>
                <div class="col  border border-light-subtle rounded mt-3 mx-3">
                    <h6 class="text-secondary">Gestion des habitats</h6>
                    <div class="pb-5 d-flex flex-wrap">
                        <div class="p-2"><a href="index.php?controller=habitat&action=add" class="col btn btn-outline-primary">Ajouter un habitat</a></div>
                        <div class="p-2"><a href="index.php?controller=habitat&action=list" class="col btn btn-outline-secondary">Voir les habitats</a></div>
                    </div>
                </div>
                <div class="col  border border-light-subtle rounded mt-3 mx-3">
                    <h6 class="text-secondary">Gestion des animaux</h6>
                    <div class="pb-5 d-flex flex-wrap">
                        <div class="p-2"><a href="index.php?controller=animal&action=add" class="col btn btn-outline-primary">Ajouter un animal</a></div>
                    </div>
                </div>
            </div>

            <div class="row border border-light-subtle rounded mt-3 mx-1 flex-wrap">
                <div class="text center">
                    <h6 class="text-secondary">Liste des animaux les plus vus</h6>
                </div>
                <div class="col">
                    <table id="animalViewsTable" class="table">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">Prénom</th>
                                <th class="text-center" scope="col">Race</th>
                                <th class="text-center" scope="col">Nombre de vues</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($animals as $key => $animal) : ?>
                                <a href="index.php?controller=animal&action=show&uuid=<?= htmlspecialchars($animals[$key]['uuid'])  ?>">
                                    <tr>
                                        <td class="text-center"><?= htmlspecialchars($animals[$key]['first_name']) ?> </td>
                                        <td class="text-center"><?= htmlspecialchars($animals[$key]['race']) ?></td>
                                        <td class="text-center"><?= htmlspecialchars($animals[$key]['viewsCounter']) ?></td>

                                    </tr>
                                </a>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                    <div><canvas id="animalViews"></canvas></div>
                </div>
                <div class="text-center">
                    <a href="index.php?controller=dashboard&action=animalViewList" class="btn btn-outline-primary mb-3">Voir tous les animaux</a>
                </div>
            </div>
            <div class="row justify-content-around border border-light-subtle rounded mt-3 mx-1">
                <div class=" table-responsive">
                    <h6 class="text-secondary">Liste des commentaires vétérinaires par habitat</h6>
                    <table id="commentHabitatTable" class="table">
                        <thead>
                            <tr>
                                <th class="text-center px-3" scope="col">Date du commentaire</th>
                                <th class="text-center px-3" scope="col">Nom de l'habitat</th>
                                <th class=" col-6 text-center px-3" scope="col">Commentaire</th>
                                <th class="text-center px-3" scope="col">Vétérinaire</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($commentsHabitat as $commentHabitat) : ?>
                                <tr>
                                    <td class="text-center"><?= htmlspecialchars($commentHabitat->getPassingDate()->format('d/m/Y')) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($commentHabitat->getHabitatName()) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($commentHabitat->getContent()) ?></td>
                                    <td class="text-center"> <?= htmlspecialchars($commentHabitat->getUserLastName()) . ' ' .
                                                                    htmlspecialchars($commentHabitat->getUserFistName()) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="text-center pb-3">
                        <a href="index.php?controller=dashboard&action=commentHabitatList" class="btn btn-outline-primary">Voir tous les commentaires</a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-around border border-light-subtle rounded mt-3 mx-1">
                <div class=" table-responsive">
                    <h6 class="text-secondary">Liste des avis vétérinaires par animal</h6>
                    <table id="reviewVeterinaryTable" class="table">
                        <thead>
                            <tr>
                                <th class="text-center px-3" scope="col">Date de l'avis<i id="dateCaret" class="bi bi-caret-up-fill"></i></th>
                                <th class="text-center px-3" scope="col">Prénom de l'animal <i id="firstNameCaret" class="bi bi-caret-up-fill"></i></th>
                                <th class="text-center px-3" scope="col">Race <i id="raceCaret" class="bi bi-caret-up-fill"></i></th>
                                <th class="text-center px-3" scope="col">Status de santé</th>
                                <th class="text-center px-3" scope="col">Nourriture proposée</th>
                                <th class="text-center px-3" scope="col">Quantité</th>
                                <th class="text-center px-3" scope="col">Vétérinaire</th>
                                <th class="text-center px-3" scope="col">Détails</th>
                            </tr>
                        </thead>
                        <tbody id="reviewVeterinaryTableBody">
                            <?php foreach ($reviewsVeterinary as $reviewVeterinary) : ?>
                                <tr>
                                    <td class="text-center"><?= htmlspecialchars($reviewVeterinary->getPassingDate()->format('d/m/Y')) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($reviewVeterinary->getAnimalFirstName()) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($reviewVeterinary->getAnimalRace()) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($reviewVeterinary->getHealthStatus()) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($reviewVeterinary->getFood()) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($reviewVeterinary->getFoodQuantity()) ?></td>
                                    <td class="text-center"> <?= htmlspecialchars($reviewVeterinary->getUserLastName()) . ' ' . htmlspecialchars($reviewVeterinary->getUserFistName()) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($reviewVeterinary->getHealthStatusDetails()) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="text-center pb-3">
                        <a href="index.php?controller=dashboard&action=reviewVeterinaryList" class="btn btn-outline-primary">Voir tous les avis</a>
                    </div>
                </div>
            </div>
    </main>

<?php };

require_once _ROOTPATH_ . '/templates/footer.php'; ?>