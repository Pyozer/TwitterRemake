<?php
/*
 * Controller de la barre de navigation
 */
use Core\Config;

$title_site = Config::get('app.title');

$template_no_connect = '<p class="navbar-text navbar-right">{{Text}} <a type="button" href="{{Lien}}" class="btn btn-primary-outline btn-smlarge navbar-btn">{{BtnName}}</a></p>';

if($id_page == "login") {
    $onglets = $template_no_connect;
    $onglets = str_replace('{{Text}}', "Vous n'avez pas de compte ?", $onglets);
    $onglets = str_replace('{{Lien}}', "/inscription.php", $onglets);
    $onglets = str_replace('{{BtnName}}', "S'inscrire", $onglets);
} elseif($id_page == "register") {
    $onglets = $template_no_connect;
    $onglets = str_replace('{{Text}}', "Vous avez déjà un compte ?", $onglets);
    $onglets = str_replace('{{Lien}}', "/connexion.php", $onglets);
    $onglets = str_replace('{{BtnName}}', "Se connecter", $onglets);
} else {
    $onglet = '';
}

require Config::get('view.paths') . 'navbar.view.php';