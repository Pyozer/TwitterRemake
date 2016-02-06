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
                                    <h1 class="page-header" style="margin-bottom: 10px;border-bottom: 1px solid #9E9E9E;text-align: center;">Connexion</h1>
                                    <?php flash(); ?>
                                    <div class="formsigin">
                                        <form method="post">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-lg floating-label" name="InputUsername" placeholder="Adresse mail ou pseudo" value="<?= isset($errors) ? $username : null; ?>" required />
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <input type="password" class="form-control input-lg floating-label" name="InputPassword" placeholder="Mot de passe" value="<?= isset($errors) ? $password : null; ?>" required />
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-primary-outline btn-smlarge" name="SubmitButton" value="Se connecter" style="margin-right: 15px;" />
                                                        <div class="checkbox checkbox-primary" style="display: inline-block;vertical-align: middle;">
                                                            <label>
                                                                <input type="checkbox" name="InputStayOnline"> Se souvenir de moi
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="other-link" style="text-align: right;margin-top: 25px;">
                                            <span>Pas encore de compte ? <a href="/inscription.php" title="Inscrivez vous">Inscrivez vous !</a></span>
                                            <br />
                                            <span style="margin-top: 5px;">Mot de passe oublié ? <a href="/forgetpassword.php" title="Mot de passe oublié">Cliquez ici</a></span>
                                        </div>
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