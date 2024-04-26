<?php require_once _ROOTPATH_ . '/templates/header.php';

use App\Security\Security; ?>
<script src="/assets/js/animal//form.js" defer></script>
<main class="container">
    <?php if (Security::isAdmin()) { ?>
        <div class="text-center pb-3">
            <h1><?= $pageTitle ?></h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-8 ">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3 text-start">
                        <label for="first_name">Prénom de l'animal</label>
                        <input type="text" class='form-control' id="first_name" name="first_name" value="" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="race">Race de l'animal</label>
                        <input type="text" class='form-control' id="race" name="race" value="" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="image">Image de l'animal</label>
                        <input type="file" class="form-control" id="image" name="image" value="">
                    </div>
                    <div class="mb-3 text-start">
                        <label for="habitat_id">Habitat de l'animal</label>
                        <select name="habitat_id" id="habitat_id" class="form-control" required>
                            <option value="">Choisir un habitat</option>
                            <?php foreach ($habitats as $habitat) : ?>
                                <option value="<?= $habitat->getId() ?>"><?= $habitat->getName() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row justify-content-center pt-2">
                        <input type="submit" id="saveAnimal" name="saveAnimal" class="btn btn-success" value="Ajouter">
                    </div>
                </form>
            </div>
        </div>

    <?php } else { ?>
        <div class="alert alert-danger">
            <span>Vous n'avez pas les droits pour ajouter un animal</span>
        </div>
    <?php } ?>
</main>

<div class="container pt-5">
    <a href="index.php?controller=habitat&action=list"><i class="bi bi-skip-backward"></i> Retour</a>
</div>
<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>