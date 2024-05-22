<?php require_once _ROOTPATH_ . '/templates/header.php';

use App\Security\Security; ?>

<main class="container">
    <?php if (Security::isVeterinary()) { ?>
        <div class="row justify-content-around border border-light-subtle rounded mt-3 mx-1">
            <div class=" table-responsive">
                <h6 class="text-secondary">Liste des consomations de nourriture pour: <?= ucfirst($animal->getFirstName()) . ", " . $animal->getRace() ?> </h6>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope=" col">Nourriture</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Date de distribution</th>
                            <th scope="col">Distribué par</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($foodConsumptions) {
                            foreach ($foodConsumptions as $foodConsumption) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($foodConsumption->getFoodName()) ?></td>
                                    <td><?= htmlspecialchars($foodConsumption->getFoodQuantity()) ?></td>
                                    <td><?= htmlspecialchars($foodConsumption->getGiveAt()->format('d-m-Y H:i')) ?></td>
                                    <td><?= htmlspecialchars($foodConsumption->getUserLastName())  . ' ' .  htmlspecialchars($foodConsumption->getUserFirstName()) ?></td>
                                </tr>
                        <?php };
                        }; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?>
</main>


<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>