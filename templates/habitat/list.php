<?php require_once _ROOTPATH_ . '/templates/header.php'; ?>
<main class="container">
    <?php

    use App\Security\Security;

    if (Security::isAdmin()) { ?>
        <div class="text-center pb-3">
            <a href="index.php?controller=habitat&action=add"><button class="btn btn-outline-primary">
                    Ajouter un habitat
                </button></a>
        </div>
    <?php } ?>
    <div class="row justify-content-center">
        <?php foreach ($habitats as $habitat) : ?>
            <div class="pb-3 col-10">
                <div class=" habitat">
                    <a href="index.php?controller=habitat&action=show&id=<?= $habitat->getId() ?>">
                        <img class="card-img-top rounded" aria-hidden="true" src='<?= $habitat->getImagePath() ?>' alt="<?= $habitat->getName() ?>">
                        <h2><?= ucwords($habitat->getName()) ?></h2>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>