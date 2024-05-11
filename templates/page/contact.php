<?php

use App\Security\Security;

require_once _ROOTPATH_ . '/templates/header.php'; ?>
<script src="/assets/js/contact/form.js" defer></script>
<?php foreach ($errors as $error) : ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
<?php endforeach; ?>

<main class="container">
    <div class="text-center pb-3">
        <h1 class="pb-4"><?= $pageTitle ?></h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-8 ">
            <form method="POST">
                <p class="col-8 text-secondary bold mb-3">Une remarque? une question? N'hésitez pas à nous écrire.</p>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    <div class='invalid-feedback'>
                        L'email n'est pas valide.
                    </div>
                </div>
                <div class="mb-3 text-start">
                    <label for="title">Objet</label>
                    <input type="text" class='form-control' id="title" name="title" placeholder="Titre" value="">
                    <div class='invalid-feedback'>
                        Le titre est requis.
                    </div>
                </div>
                <div class="mb-3 text-start">
                    <label for="message">Votre message</label>
                    <textarea class='form-control' id="message" name="message" placeholder="Ecrivez votre remarque/question ici..." rows="10"></textarea>
                    <div class='invalid-feedback'>
                        Le message est requis.
                    </div>
                </div>
                <div class="row justify-content-center pt-2">
                    <input type="submit" id="sendMail" name="sendMail" class="btn btn-success" value="Envoyer" disabled>
                </div>
            </form>
        </div>
    </div>
</main>
<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>