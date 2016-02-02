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
                                    <h1 class="page-header" style="margin-bottom: 35px;border-bottom: 1px solid #9E9E9E;text-align: center;">Connexion</h1>
                                    <?php flash(); ?>
                                    <div class="formsigin">
                                        <form method="post">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-lg" name="InputUsername" placeholder="Adresse mail ou pseudo" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control input-lg" name="InputPassword" placeholder="Mot de passe" required>
                                            </div>
                                            <hr />
                                            <input type="submit" class="btn btn-primary btn-block btn-smlarge" name="SubmitButton" value="Se connecter">
                                            <div class="checkbox" style="float: left;margin-top: 25px;">
                                                <label>
                                                    <input type="checkbox" name="InputStayOnline">Rester connecté</label>
                                            </div>
                                        </form>
                                        <span style="float: right;margin-top: 25px;">Pas encore de compte ? <a href="/inscription.php" title="Inscrivez vous">Inscrivez vous !</a></span>
                                        <span style="float: right;margin-top: 5px;">Mot de passe oublié ? <a href="/forgetpassword.php" title="Mot de passe oublié">Cliquez ici</a></span>
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