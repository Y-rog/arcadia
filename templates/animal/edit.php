<?php require_once _ROOTPATH_ . '/templates/header.php';
/**
 * @var \APP\Entity\Animal $animal */ ?>


<div class="main-form">
    <form method="POST">
        <div class="form-group">
            <label for="first_name">Prénom de l'animal</label>
            <input type="text" class='form-control' id="first_name" name="first_name" value="<?= $animal->getFirstname() ?>" required>
        </div>
        <div class="form-group">
            <label for="race">Race de l'animal</label>
            <input type="text" class='form-control' id="race" name="race" value="<?= $animal->getRace() ?>" required>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class='form-control' id="image" name="image" value="<?= $animal->getImage() ?>" required>
        </div>
        <div class="form-group">
            <label for="habitat_id">Habitat de l'animal</label>
            <select name="habitat_id" id="habitat_id" required>
                <option value="">Choisir un habitat</option>
                <?php foreach ($habitats as $habitat) : ?>
                    <option value="<?= $habitat->getId() ?>"><?= $habitat->getName() ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-btn">
            <input type="submit" id="saveAnimal" name="saveAnimal" class="btn-validate-form" value="Modifier">
        </div>
    </form>
</div>

<div class="back">
    <i class="fa-solid fa-angles-left"></i><a href="index.php?controller=animal&action=add">Retour</a>
</div>
<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>


<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>