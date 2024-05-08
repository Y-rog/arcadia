<?php require_once _ROOTPATH_ . '/templates/header.php'; ?>
<script src="/assets/js/dashboard/reviewVeterinary.js" defer></script>
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
                        <td class="text-center"><?= $reviewVeterinary->getCreatedAt()->format('d/m/Y'); ?></td>
                        <td class="text-center"><?= $reviewVeterinary->getAnimalFirstName() ?></td>
                        <td class="text-center"><?= $reviewVeterinary->getAnimalRace(); ?></td>
                        <td class="text-center"><?= $reviewVeterinary->getHealthStatus(); ?></td>
                        <td class="text-center"><?= $reviewVeterinary->getFood(); ?></td>
                        <td class="text-center"><?= $reviewVeterinary->getFoodQuantity(); ?></td>
                        <td class="text-center"> <?= $reviewVeterinary->getUserLastName() . ' ' . $reviewVeterinary->getUserFistName() ?></td>
                        <td class="text-center"><?= $reviewVeterinary->getHealthStatusDetails(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</main>

<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>