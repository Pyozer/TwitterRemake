<?php
use Core\Config;

require Config::get('app.include_paths') . 'header.php';
require Config::get('app.controller_paths') . 'navbar.php';
?>
<div class="page">
    <table class="showcase">
        <tbody>
            <tr>
                <td>
                    <div class="showcase-inner">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                                    <h1 class="page-header" style="margin-bottom: 35px;border-bottom: 1px solid #9E9E9E;text-align: center;">Inscription</h1>
                                    <?php flash(); ?>
                                    <div class="formsigup">
                                        <form method="post">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">@</div>
                                                    <input type="text" class="form-control input-lg" name="InputPseudo" placeholder="Pseudo" value="<?php if(isset($errors)) { echo $pseudo; } ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-6">
                                                        <input type="text" class="form-control input-lg" name="InputPrenom" placeholder="Prénom" value="<?php if(isset($errors)) { echo $prenom; } ?>" required>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                        <input type="text" class="form-control input-lg" name="InputNom" placeholder="Nom" value="<?php if(isset($errors)) { echo $nom; } ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control input-lg" name="InputEmail" placeholder="Adresse mail" value="<?php if(isset($errors)) { echo $email; } ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control input-lg" name="InputPassword" placeholder="Mot de passe" value="<?php if(isset($errors)) { echo $password; } ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control input-lg" name="InputPassword2" placeholder="Confirmer mot de passe" value="<?php if(isset($errors)) { echo $confirmpassword; } ?>" required>
                                            </div>
                                            <hr />
                                            <input type="submit" name="submitRegister" class="btn btn-primary btn-block btn-smlarge" value="S'inscrire">
                                        </form>
                                        <span style="float: right;margin-top: 25px;">Vous avez déjà un compte ? <a href="/connexion.php" title="Connectez vous">Connectez vous !</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php require Config::get('app.include_paths') . 'footer.php'; ?>