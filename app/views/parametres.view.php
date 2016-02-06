<?php
use Core\Config;

require Config::get('app.include_paths') . 'header.php';
require Config::get('app.controller_paths') . 'Navbar.php';
?>
<div class="page-padding">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                <div class="profil_edit">
                    <h2 class="page-header centered">Paramètres</h2>
                    <?php flash(); ?>
                    <form method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="inputUsername" class="col-sm-2 control-label"><strong>Nom d'utilisateur</strong></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control input-lg" id="inputUsername" name="inputUsername" placeholder="Nom d'utilisateur" value="<?= $pseudo; ?>" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label"><strong>Adresse mail</strong></label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control input-lg" id="inputEmail" name="inputEmail" placeholder="Votre adresse mail" value="<?= $email; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary-outline btn-smlarge" name="SubmitProfil">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                    <hr />
                    <form method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="inputPassword" class="col-sm-2 control-label"><strong>Mot de passe actuel</strong></label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control input-lg" id="inputPassword" name="inputPassword" placeholder="Mot de passe actuel" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputNewPassword" class="col-sm-2 control-label"><strong>Nouveau mot de passe</strong></label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control input-lg" id="inputNewPassword" name="inputNewPassword" placeholder="Nouveau mot de passe" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputNewPassword2" class="col-sm-2 control-label"><strong>Confirmer mot de passe</strong></label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control input-lg" id="inputNewPassword2" name="inputNewPassword2" placeholder="Confirmer mot de passe" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary-outline btn-smlarge" name="SubmitPassword">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require Config::get('app.include_paths') . 'footer.php'; ?>