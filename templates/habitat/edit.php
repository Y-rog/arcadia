<?php require_once _ROOTPATH_ . '/templates/header.php'; ?>
<script src="../../assets/js/habitat/form.js" defer></script>
<main class="container">
    <div class="text-center pb-3">
        <h1>Modifier l'habitat : <?= ucfirst($habitat->getNAme()) ?></h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-8 ">
            <form method="POST">
                <div>
                    <input type="hidden" name="id" value="<?= $habitat->getId() ?>">
                </div>
                <div class="mb-3 text-start">
                    <label for="name" class="form-label">Nom de l'habitat</label>
                    <input type="text" value="<?= $habitat->getName(); ?>" class='form-control' id="name" name="name">
                </div>
                <div class="mb-3 text-start">
                    <label for="description" class="form-label">Description de l'habitat</label>
                    <input type="text" value="<?= $habitat->getDescription(); ?>" class='form-control' id="description" name="description">
                </div>
                <div class="mb-3 text-start">
                    <label for="image" class="form-label">Image de l'habitat</label>
                    <input type="file" class="form-control" value="<?= $habitat->getImage(); ?>" id="image" name="image">
                </div>
                <div class="row justify-content-center pt-2">
                    <input type="submit" id="saveHabitat" name="saveHabitat" class="btn btn-primary" value="Modifier">
                </div>
            </form>
        </div>

        <div class="container pt-5">
            <a href="index.php?controller=habitat&action=list"><i class="bi bi-skip-backward"></i> Retour</a>
        </div>
    </div>
</main>
<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>