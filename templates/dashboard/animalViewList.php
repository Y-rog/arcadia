<?php require_once _ROOTPATH_ . '/templates/header.php'; ?>

<main class="container">
    <div class="row border border-light-subtle rounded mt-3 mx-1 flex-wrap">
        <div class="text center">
            <h6 class="text-secondary">Liste des animaux les plus vus</h6>
        </div>
        <table class="table">
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
</main>
<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>