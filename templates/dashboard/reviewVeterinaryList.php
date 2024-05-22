<?php

use App\Security\Security;

require_once _ROOTPATH_ . '/templates/header.php'; ?>
<script src="/assets/js/dashboard/reviewVeterinaryList.js" defer></script>
<?php if (Security::isAdmin()) {  ?>
    <main class="container">
        <div class="row justify-content-around border border-light-subtle rounded mt-3 mx-1">
            <div class=" table-responsive">
                <h6 class="text-secondary">Liste des avis vétérinaires par animal</h6>
                <form id="reviewVeterinaryForm" class="form-inline justify-content-center row">
                    <div class="form-group mb-3 col-8">
                        <label for="animalFirstName" class="sr-only">Prénom de l'animal</label>
                        <input type="text" class="form-control" id="animalFirstName">
                    </div>
                    <div class=" form-group mb-3 col-md-6">
                        <label for="firstDate" class="sr-only">Date de début</label>
                        <input type="text" class="form-control" id="firstDate" placeholder="jj//mm/aaaa">
                    </div>
                    <div class="form-group mb-3 col-md-6">
                        <label for=" lastDate" class="sr-only">Date de fin</label>
                        <input type="text" class="form-control" id="lastDate" placeholder="jj//mm/aaaa">
                    </div>
                    <div class="form-group mb-3 text-center col-sm-6">
                        <button type="button" class="btn btn-success" id="search">Rechercher</button>
                    </div>
                    <div class="form-group mb-3 text-center col-sm-6">
                        <button type="button" class="btn btn-secondary" id="reset">Réinitialiser</button>
                    </div>
                </form>
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
                                <td class="text-center"><?= htmlspecialchars($reviewVeterinary->getpassingDate()->format('d/m/Y')) ?></td>
                                <td class="text-center"><?= htmlspecialchars($reviewVeterinary->getAnimalFirstName()) ?></td>
                                <td class="text-center"><?= htmlspecialchars($reviewVeterinary->getAnimalRace()); ?></td>
                                <td class="text-center"><?= htmlspecialchars($reviewVeterinary->getHealthStatus()); ?></td>
                                <td class="text-center"><?= htmlspecialchars($reviewVeterinary->getFood()); ?></td>
                                <td class="text-center"><?= htmlspecialchars($reviewVeterinary->getFoodQuantity()); ?></td>
                                <td class="text-center"> <?= htmlspecialchars($reviewVeterinary->getUserLastName()) . ' ' . htmlspecialchars($reviewVeterinary->getUserFistName()) ?></td>
                                <td class="text-center"><?= htmlspecialchars($reviewVeterinary->getHealthStatusDetails()); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
<?php };
require_once _ROOTPATH_ . '/templates/footer.php'; ?>