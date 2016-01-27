<?php
use Core\Config;

require Config::get('app.include_paths') . 'header.php';

require Config::get('app.controller_paths') . 'navbar.php';
?>
<div class="page">
    <table class="showcase last-showcase no-next-arrow share">
        <tbody>
        <tr>
            <td>
                <div class="showcase-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                                <h1 class="page-header" style="margin-bottom: 35px;border-bottom: 1px solid #9E9E9E;text-align: center;">Connexion</h1>
                                <div class="formsigin">
                                    <form method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control input-lg" id="InputUsername" placeholder="Adresse mail ou pseudo" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control input-lg" id="InputPassword" placeholder="Mot de passe" required>
                                        </div>
                                        <hr />
                                        <button type="submit" class="btn btn-primary btn-block btn-smlarge">Se connecter</button>
                                    </form>
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