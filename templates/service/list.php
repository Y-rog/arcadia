<?php require_once _ROOTPATH_ . '/templates/header.php';

use App\Security\Security; ?>

<main class="container">
    <div class="col-10 mx-auto">
        <div>
            <img src="/assets/img/restauration.jpg" class="img-fluid rounded" alt="services">
            <p class="lead">Le zoo vous propose plusieurs services:</p>
        </div>

        <?php if (Security::isAdmin()) { ?>
            <div class="text-center pb-3">
                <a href="index.php?controller=service&action=add"><button class="btn btn-outline-primary">
                        Ajouter un service
                    </button></a>
            </div>
        <?php } ?>
        <?php foreach ($services as $service) : ?>
            <div class="py-3">
                <h6 class="text-secondary"><?= htmlspecialchars($service->getName()); ?></h6>
                <ul class="list-group list-group-flush list-group-horizontal">
                    <li class="list-group-item "><?= htmlspecialchars($service->getDescription()); ?></li>
                    <div class="d-flex justify-content-around pt-2">
                        <?php if (Security::isAdmin() || Security::isEmployee()) { ?>
                            <a href="index.php?controller=service&action=edit&id=<?= $service->getId(); ?>"><button class=" btn btn-outline-secondary">Modifier</button></a>
                        <?php } ?>
                        <?php if (Security::isAdmin()) { ?>
                            <a><button class=" btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteService<?= htmlspecialchars($service->getId()) ?>">Supprimer</button></a>
                            <div class="modal fade" id="deleteService<?= htmlspecialchars($service->getId()) ?>" tabindex="-1" aria-labelledby="addReviewLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content text-center">
                                        <div class="modal-body">
                                            <p>Etes-vous sûr de vouloir supprimer ce service?</p>
                                            <form method="POST" class="pb-2">
                                                <input type="hidden" name="id" value="<?= htmlspecialchars($service->getId()) ?>">
                                                <input type="submit" class="btn btn-danger" value="Supprimer" name="deleteService">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
            </div>
        <?php endforeach; ?>
</main>
<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>