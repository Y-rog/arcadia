<?php require_once _ROOTPATH_ . '/templates/header.php'; ?>
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
                <a href="index.php?controller=user&action=register" class="btn btn-outline-primary">Modifier les horaires</a>
            </div>
        </div>
    </div>
    <div class="d-flex row justify-content-center flex-wrap">
        <div class="col border border-light-subtle rounded mt-3 mx-3">
            <h6 class="text-secondary">Gestion des services</h6>
            <div class=" pb-5 d-flex flex-wrap">
                <div class="p-2"><a href="#" class="col btn btn-outline-primary">Ajouter un service</a></div>
                <div class="p-2"><a href="#" class="col btn btn-outline-secondary">Voir les services</a></div>
            </div>
        </div>
        <div class="col  border border-light-subtle rounded mt-3 mx-3">
            <h6 class="text-secondary">Gestion des habitats</h6>
            <div class="pb-5 d-flex flex-wrap">
                <div class="p-2"><a href="#" class="col btn btn-outline-primary">Ajouter un habitat</a></div>
                <div class="p-2"><a href="#" class="col btn btn-outline-secondary">Voir les habitats</a></div>
            </div>
        </div>
        <div class="col  border border-light-subtle rounded mt-3 mx-3">
            <h6 class="text-secondary">Gestion des animaux</h6>
            <div class="pb-5 d-flex flex-wrap">
                <div class="p-2"><a href="#" class="col btn btn-outline-primary">Ajouter un animal</a></div>
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
                        <a href="index.php?controller=animal&action=show&uuid=<?= $animals[$key]['uuid']  ?>">
                            <tr>
                                <td class="text-center"><?= $animals[$key]['first_name']; ?> </td>
                                <td class="text-center"><?= $animals[$key]['race'] ?></td>
                                <td class="text-center"><?= $animals[$key]['viewsCounter']; ?></td>

                            </tr>
                        </a>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col">
            <div><canvas id="animalViews"></canvas></div>
        </div>
    </div>
    <div class="row justify-content-around border border-light-subtle rounded mt-3 mx-1">
        <div class="text center table-responsive">
            <h6 class="text-secondary">Liste des avis vétérinaires les plus récents</h6>
            <table id="reviewVeterinaryTable" class="table">
                <thead>
                    <tr>
                        <th id="firstNameCaret" class="text-center px-3" scope="col">Prénom de l'animal <i class="bi bi-caret-up-fill"></i></th>
                        <th id="raceCaret" class="text-center px-3" scope="col">Race <i class="bi bi-caret-up-fill"></i></th>
                        <th class="text-center px-3" scope="col">Status de santé</th>
                        <th class="text-center px-3" scope="col">Nourriture proposée</th>
                        <th class="text-center px-3" scope="col">Quantité</th>
                        <th class="text-center px-3" scope="col">Détails</th>
                        <th class="text-center px-3" scope="col">Vétérinaire</th>
                        <th id="dateCaret" class="text-center px-3" scope="col">Date de l'avis<i class="bi bi-caret-down-fill"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reviewsVeterinary as $reviewVeterinary) : ?>
                        <tr>
                            <td class="text-center"><?= $animalSql->getFirstName(); ?></td>
                            <td class="text-center"><?= $animalSql->getRace(); ?></td>
                            <td class="text-center"><?= $reviewVeterinary->getHealthStatus(); ?></td>
                            <td class="text-center"><?= $reviewVeterinary->getFood(); ?></td>
                            <td class="text-center"><?= $reviewVeterinary->getFoodQuantity(); ?></td>
                            <td class="text-center"><?= $reviewVeterinary->getHealthStatusDetails(); ?></td>
                            <td class="text-center"><?= $user->getFirstname(); ?>, <?= $user->getLastName(); ?></td>
                            <td class="text-center"><?= $reviewVeterinary->getCreatedAt()->format('d/m/Y'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
</main>

<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>