<?php

use App\Security\Security;

require_once _ROOTPATH_ . '/templates/header.php'; ?>


<main class="container pt-1 pb-5">
    <div class="justify-content-center text-center pb-3">
        <h1 class="pb-3">Liste des avis</h1>
        <div class="text-center row justify-content-evenly reviews">
            <!-- On récupère tout les avis -->
            <?php if (Security::isEmployee() | Security::isAdmin()) {
                foreach ($reviews as $review) { ?>
                    <div class="border rounded pt-2 mb-3 fst-italic col-10">
                        <p><?= htmlspecialchars($review->getContent()) ?></p>
                        <div class="blockquote-footer"><?= htmlspecialchars($review->getUsername()); ?>, le <?= htmlspecialchars(($review->getCreatedAt())->format('d/m/Y')) ?></div>
                        <!-- Si l'utilisateur est connecté et est un employé ou un admin, on affiche les boutons de validation, de mise en avant et de suppression -->
                        <div class="d-flex justify-content-between align-items-center">
                            <form method="POST" class="pb-2">
                                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($review->getId()) ?>">
                                <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id']; ?>">
                                <?php if ($review->getIsValidated() == 0) { ?>
                                    <input type="submit" class="btn btn-success" value="Valider" name="validateReview">
                                <?php } else { ?>
                                    <input type="submit" class="btn btn-outline-success" value="Invalider" name="unvalidateReview">
                                <?php } ?>
                            </form>
                            <?php if ($review->getIsValidated() == 1) { ?>
                                <form method="POST" class="pb-2">
                                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($review->getId()) ?>">
                                    <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id']; ?>">
                                    <?php if ($review->getOnHomePage() == 0) { ?>
                                        <button type="submit" class="btn fs-3 bi bi-star" name="favoriteReview">
                                        </button>
                                    <?php } else { ?>
                                        <button type="submit" class="btn  fs-3 bi bi-star-fill" name="unfavoriteReview">
                                        </button>
                                    <?php } ?>
                                </form>
                            <?php } ?>
                            <div class="pb-2">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteReview">
                                    Supprimer
                                </button>
                            </div>
                            <div class="modal fade" id="deleteReview" tabindex="-1" aria-labelledby="addReviewLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <p>Etes-vous sûr de vouloir supprimer cet avis?</p>
                                            <form method="POST" class="pb-2">
                                                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                                                <input type="hidden" name="id" value="<?= htmlspecialchars($review->getId()) ?>">
                                                <input type="submit" class="btn btn-danger" value="Supprimer" name="deleteReview">
                                            </form>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
            } else {
                foreach ($reviews as $review) { ?>
                    <div class="border rounded pt-2 mb-3 fst-italic col-10">
                        <p><?= htmlspecialchars($review->getContent()) ?></p>
                        <div class="blockquote-footer"><?= htmlspecialchars($review->getUsername()) ?>, le <?= htmlspecialchars(($review->getCreatedAt())->format('d/m/Y')) ?></div>
                    </div>
            <?php }
            }
            ?>
        </div>

        <!-- Pagination -->
        <div class=" d-flex justify-content-center my-4">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php if ($currentPage > 1) { ?>
                        <li class="page-item">
                            <a class="page-link" href=" index.php?controller=review&action=list&page=<?= $currentPage - 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php for ($i = 1; $i <= $pages; $i++) {
                        if ($i == $currentPage) { ?>
                            <li class="page-item active"><a class="page-link " href="index.php?controller=review&action=list&page=<?= $i ?>"><?= $i ?></a></li>
                        <?php } else { ?>
                            <li class="page-item"><a class="page-link" href="index.php?controller=review&action=list&page=<?= $i ?>"><?= $i ?></a></li>
                    <?php }
                    } ?>
                    <?php if ($currentPage < $pages) { ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?controller=review&action=list&page=<?= $currentPage + 1 ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>

        </div>
    </div>
    <div class="container pt-5">
        <a href="index.php?controller=page&action=home"><i class="bi bi-skip-backward"></i> Retour</a>
    </div>
</main>



<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>