<?php require_once _ROOTPATH_ . '/templates/header.php'; ?>
<script src="/assets/js/auth/login.js"></script>

<main class="container pt-5 pb-5">
    <div class="text-center pb-3">
        <h1>Connexion</h1>
    </div>
    <?php foreach ($errors as $error) { ?>
        <div class="alert alert-danger" role="alert">
            <?= $error; ?>
        </div>
    <?php } ?>
    <div class="row justify-content-center">
        <div class="col-8 ">
            <form method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="row justify-content-center pt-2">
                    <input type="submit" id="loginUser" name="loginUser" class="btn btn-success" value="Connexion">
                </div>
            </form>
        </div>
    </div>

</main>



<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>