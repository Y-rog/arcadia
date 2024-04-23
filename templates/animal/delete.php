<?php require_once _ROOTPATH_ . '/templates/header.php'; ?>
<div class="confirm-delete">
    <h2>Êtes-vous sûr de vouloir supprimer cet animal?</h2>
    <div class="form-container">
        <form method="POST">
            <button class='btn-validate-form' type='submit' id="delete" name='delete'>Confimer</button>
            <a href=<?= $pathShow ?>><button class='btn-cancel-form' type='button'>Annuler</button></a>
        </form>
    </div>
</div>
<div class="container-animal-show">
    <div class="img-animal"> <img src=<?= $image ?> alt="">
    </div>
    <div class="info-animal">
        <table>
            <tr>
                <th>Prénom:</th>
                <td><?= $first_name ?></td>
            </tr>
            <tr>
                <th>Race:</th>
                <td><?= $race ?></td>
            </tr>
            <tr>
                <th>Habitat:</th>
                <td><?= $habitatName ?></td>
            </tr>
        </table>
    </div>
</div>
<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>