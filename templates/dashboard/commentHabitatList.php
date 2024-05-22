<?php require_once _ROOTPATH_ . '/templates/header.php'; ?>
<main class="container">
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
        </div>
    </div>
</main>

<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>