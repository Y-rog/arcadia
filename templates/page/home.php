<?php require_once _ROOTPATH_ . '/templates/header.php' ?>
<script src="/assets/js/home/review.js" defer></script>

<main class="container">
    <div class="home-big-title text-center pb-3">
        <img class="rounded " src="../../assets/img/home-elephant.jpg" alt="image elephant" aria-hidden="true">
        <h1 class="bg-white rounded">Bienvenue à Arcadia</h1>
    </div>
    <div class=" container-fluid horaries text-center rounded pt-3 pb-3">
        <span> Ouvert du Mardi au Dimanche de 9h à 18h</span>
    </div>

    <hr class="featurette-divider">
    <div class="row featurette">
        <div class="col-md-7">
            <h3 class="featurette-heading fw-normal lh-1">Vivez une experience inoubliable! <span class="text-body-secondary">Au coeur d'une naturé préservée.</span></h3>
            <p>Situé en Bretagne proche de la forêt de Brocéliande, nous sommes heureux de vous accueillir
                depuis 1960.</p>
        </div>
        <div class="col-md-5">
            <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto rounded" src="../../assets/img/girafe-zebre-home.jpg" widht="500" height="500" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false">
        </div>
    </div>
    <hr class="featurette-divider">
    <div class="row featurette reverse">
        <div class="col-md-7 order-md-2">
            <h3 class="featurette-heading fw-normal lh-1">Partez à l'aventure! <span class="text-body-secondary">Découvrez plus de 50 espèces d’animaux.</span></h3>
            <p>Notre zoo est divisé en plusieurs habitats: la savane, la jungle et le marais. </p>
        </div>
        <div class="col-md-5 order-md-1">
            <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto rounded" src="../../assets/img/tiger-home.png" widht="500" height="500" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false">
        </div>
    </div>
    <hr class="featurette-divider">
    <div class="row featurette">
        <div class="col-md-7">
            <h3 class="featurette-heading fw-normal lh-1">Partez serain!<span class="text-body-secondary"> Nous avons pensé à tout.</span></h3>
            <p>Le parc vous propose plusieurs services pour agrémenter votre visite.</p>
        </div>
        <div class="col-md-5">
            <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto rounded" src="../../assets/img/visite-guide.jpg" widht="500" height="500" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false">
        </div>
    </div>
    <hr class="featurette-divider">
    <div class=" container-fluid value text-center rounded pt-3 pb-3">
        <span> Le respect de nos valeurs et de nos animaux est très important! </span>
    </div>
    <div class="row text-center pt-3">
        <div class="col-lg-4">
            <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="../../assets/img/panda.jpg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
            <h2 class="fw-normal">Bien être</h2>
            <p>Soucieux du bien être de nos animaux, nous avons reproduits leurs habitats naturels.</p>
        </div>
        <div class="col-lg-4">
            <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="../../assets/img/veterinary.jpg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
            <h2 class="fw-normal">Santé</h2>
            <p>La santé de nos animaux est primordiale, plusieurs vétérinaires contrôlent avant ouverture du zoo de la bonne santé des animaux.</p>
        </div>
        <div class="col-lg-4">
            <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="../../assets/img/environmental-protection.jpg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
            <h2 class="fw-normal">Ecologie</h2>
            <p>Engagé également pour la protection de l’environnement, notre zoo est autosuffisant en énergies.</p>
        </div>
    </div>
    <hr class="featurette-divider">
    <div class="text-center row justify-content-center reviews">
        <h3 class="pb-2">Nos visiteurs témoignent!</h3>
        <div class="pb-3">
            <!-- Button trigger modal -->
            <button type="button" id="btn-add-review" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddReview">
                Ajouter un avis
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalAddReview" tabindex="-1" aria-labelledby="addReviewLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title text-center fs-5" id="addReviews">Ajouter un avis</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <div class=" mb-3">
                                <div class=" mb-3 text-start">
                                    <label for="user_name" class="form-label">Pseudo</label>
                                    <input type="user_name" class="form-control" id="user_name" name="user_name">
                                </div>
                                <div class="mb-3 text-start ">
                                    <label for="content" class="form-label">Avis</label>
                                    <textarea class="form-control" id="content" name="content"></textarea>
                                </div>
                                <div>
                                    <input type="hidden" name="is_validated" value="0">
                                </div>
                                <div class="row d-flex justify-content-center pt-2">
                                    <input type="submit" name="addReview" id="addReview" class="btn btn-success" value="Envoyer" disabled>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php foreach ($reviews as $review) { ?>
            <div class="border rounded pt-2 mb-3 fst-italic col-10">
                <p><?= $review->getContent() ?></p>
                <div class="blockquote-footer"><?= $review->getUsername(); ?>, le <?= ($review->getCreatedAt())->format('d/m/Y'); ?></div>
            </div>
        <?php } ?>
        <a href="index.php?controller=review&action=list&page=1">Voir plus</a>
    </div>

</main>

<?php require_once _ROOTPATH_ . '/templates/footer.php' ?>