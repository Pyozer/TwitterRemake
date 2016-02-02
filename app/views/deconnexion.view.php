<?php
use Core\Config;

require Config::get('app.include_paths') . 'header.php';

require Config::get('app.controller_paths') . 'navbar.php';
?>
<!-- On met un loader d'environ 1 seconde -->
<META http-equiv="refresh" content="1; URL=/home.php">

<div class="page">
    <table class="showcase">
        <tbody>
            <tr>
                <td>
                    <div class="showcase-inner">
                        <div class="container">
                            <div class="row centered">
                                <div class="col-xs-12 col-sm-10 col-md-6 col-sm-offset-1 col-md-offset-3" style="margin-bottom: 25px;">
                                    <img src="/assets/img/logo/logo.svg" style="width: 230px;height: 230px;">
                                </div>
                            </div>
                            <div class="row centered">
                                <div class="col-xs-10 col-xs-offset-1">
                                    <h2 style="margin-bottom: 50px;">Déconnexion en cours...</h2>
                                    <div class="loader">
                                        <svg class="circular" viewBox="25 25 50 50">
                                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
                                        </svg>
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