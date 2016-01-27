<?php
use Core\Config;
require Config::get('app.include_paths') . 'header.php';
?>

<div class="page_home">
    <table class="showcase last-showcase no-next-arrow share">
        <tbody>
            <tr>
                <td>
                    <div class="showcase-inner">
                        <h1><?= $title_site; ?></h1>
                        <h2>
                            Connectez-vous à vos amis, et à bien d'autres personnes.<br />
                            Recevez des mises à jour instantannées sur les choses qui vous intéressent.<br />
                            Partage ton avis sur un évènement en temps réel grâce au hashtag.
                        </h2>
                        <div class="container" style="margin-top: 45px;margin-bottom: 35px;">
                            <hr />
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-3 col-sm-offset-2 col-md-offset-3 centered">
                                    <a type="button" class="btn btn-primary-outline btn-block" href="/login.php" title="Se connecter">Se connecter</a>
                                    <br />
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-3 centered">
                                    <a type="button" class="btn btn-primary-outline btn-block" href="/inscription.php" title="S'inscrire">S'inscrire</a>
                                    <br />
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