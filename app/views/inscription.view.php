<?php
use Core\Config;

require Config::get('app.include_paths') . 'header.php';
require Config::get('app.controller_paths') . 'Navbar.php';
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
                                    <h1 class="page-header" style="margin-bottom: 10px;border-bottom: 1px solid #9E9E9E;text-align: center;">Inscription</h1>
                                    <?php flash(); ?>
                                    <div class="formsigup">
                                        <form method="post">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-lg floating-label" name="InputPseudo" placeholder="Pseudo" value="<?= isset($errors) ? $pseudo : null; ?>" required />
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-lg floating-label" name="InputPrenom" placeholder="Prénom" value="<?= isset($errors) ? $prenom : null; ?>" required />
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-lg floating-label" name="InputNom" placeholder="Nom" value="<?= isset($errors) ? $nom : null; ?>" required />
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <input type="email" class="form-control input-lg floating-label" name="InputEmail" placeholder="Adresse mail" value="<?= isset($errors) ? $email : null; ?>" required />
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <input type="password" class="form-control input-lg floating-label" name="InputPassword" placeholder="Mot de passe" required />
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <input type="password" class="form-control input-lg floating-label" name="InputPassword2" placeholder="Confirmer mot de passe" required />
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <input type="submit" name="submitRegister" class="btn btn-primary btn-block btn-smlarge" value="S'inscrire" />
                                                    </div>
                                                </div>
                                            </div>
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