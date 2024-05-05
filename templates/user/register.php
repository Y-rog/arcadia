<?php require_once _ROOTPATH_ . '/templates/header.php';

use App\Security\Security; ?>
<script src="/assets/js/user/register.js" defer></script>
<?php foreach ($errors as $error) : ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
<?php endforeach;
if (Security::isAdmin()) {  ?>
    <main class="container">
        <div class="row justify-content-center">
            <div class="text-center pb-3">
                <h1>Inscription</h1>
            </div>
            <div class="col-8">
                <form method="POST">
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Nom">
                        <div class='invalid-feedback'>
                            Le nom est requis.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Prénom">
                        <div class='invalid-feedback'>
                            Le prénom est requis.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        <div class='invalid-feedback'>
                            L'email n'est pas valide.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Rôle</label>
                        <select name="role" id="role" class="form-control">
                            <option value="employee">Employé</option>
                            <option value="veterinary">Vétérinaire</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class='invalid-feedback'>
                            Le mot de passe n'est pas valide. Il doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.
                        </div>
                        <div class='valid-feedback'>
                            Le mot de passe est valide.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirmer votre mot de passe</label>
                        <input type="password" class="form-control" id="confirmPassword">
                        <div class='invalid-feedback'>
                            Les mots de passe ne correspondent pas.
                        </div>
                    </div>
                    <div class="mb3 text-center">
                        <button type="submit" id="saveUser" name="saveUser" class="btn btn-success" disabled>Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
        <div class=" d-flex justify-content-start pl-3 ml-3">
            <a class="icon-link icon-link-hover" style="--bs-link-hover-color-rgb: 25, 135, 84;" href="index.php?controller=page&action=home">
                <i class="bi bi-arrow-left" aria-hidden="true">Retour</i>
            </a>
        </div>
        </div>
    </main>
<?php } else { ?>
    <div class="alert alert-danger" role="alert">
        Vous n'avez pas les droits pour accéder à cette page.
    </div>
<?php } ?>
<?php require_once _ROOTPATH_ . '/templates/footer.php'; ?>