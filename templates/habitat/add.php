<?php require_once _ROOTPATH_ . '/templates/header.php'; ?>
<script src="/assets/js/habitat/form.js" defer></script>
<main class="container">
    <div class="text-center pb-3">
        <h1>Ajouter un Habitat</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-8 ">
            <form method="POST">
                <div class="mb-3 text-start">
                    <label for="name" class="form-label">Nom de l'habitat</label>
                    <input type="text" class='form-control' id="name" name="name" value="" required>
                </div>
                <div class="mb-3 text-start">
                    <label for="description" class="form-label">Description de l'habitat</label>
                    <input type="text" class='form-control' id="description" name="description" value="" required>
                </div>
                <div class="mb-3 text-start">
                    <label for="image" class="form-label">Image de l'habitat</label>
                    <input type="file" class="form-control" id="image" name="image" value="" required>
                </div>
                <div class="row justify-content-center pt-2">
                    <input type="submit" id="saveHabitat" name="saveHabitat" class="btn btn-primary" value="Ajouter">
                </div>
            </form>
        </div>

        <div class="container pt-5">
            <a href="index.php?controller=habitat&action=list"><i class="bi bi-skip-backward"></i> Retour</a>
        </div>
    </div>
</main>
<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>