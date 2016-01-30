<?php
/*
 * Controller de la barre de navigation
 */
use Core\Config;

$title_site = Config::get('app.title');

/* Si l'utilisateur n'est pas connecté
 * On affiche les menus inscription et connexion
 */
if(!connect()) {
    if($id_page == "login") {
        $text = "Vous n'avez pas encore de compte ?";
        $href = "/inscription.php";
        $textBtn = "S'inscrire";
        $imgtwitter = null;

    } elseif($id_page == "register") {
        $text = "Vous avez déjà un compte ?";
        $href = "/connexion.php";
        $textBtn = "Se connecter";
        $imgtwitter = null;
    }
    $template_no_connect = "<p class=\"navbar-text navbar-right\">{$text} <a type=\"button\" href=\"{$href}\" class=\"btn btn-primary-outline btn-smlarge navbar-btn\" id=\"navbar-btn-noconnect\">{$textBtn}</a></p>";

    $onglets = $template_no_connect;
} else {
    $activehome = ($id_page == "index") ? 'class="active"' : "";
    $activenotif = ($id_page == "notification") ? 'class="active"' : "";
    $activemsg = ($id_page == "message") ? 'class="active"' : "";

    $onglets = '
    <ul class="nav navbar-nav navbar-left">
        <li '.$activehome.'><a href="/" title="Accueil"><i class="fa fa-home"></i> Accueil</a></li>
        <li '.$activenotif.'><a href="/notifications.php" title="Mes notifications"><i class="fa fa-bell"></i> Notifications</a></li>
        <li '.$activemsg.'><a href="/messages.php" title="Mes messages" id="liamis"><i class="fa fa-envelope"></i> Messages</a></li>
    </ul>
    <a type="button" class="btn btn-primary-outline navbar-btn navbar-right"><i class="fa fa-paper-plane"></i> Tweeter</a>
    <ul class="nav navbar-nav navbar-right" style="margin-right: 10px;">    
        <li class="dropdown">
            <a href="javascript:void(0)" data-target="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img class="img-rounded navbar-img-profil" src="http://interminale.fr.nf/images/profil/02192cc8dbd3607529cc54f61c9763ef128e0e26.jpg"> <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a href="/profil" title="Votre profil"><strong>Jean-Charles Moussé</strong><br/><small>Voir mon profil</small></a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/parametres" title="Paramètre du compte">Paramètres</a></li>
                <li><a href="/deconnexion?logout=true" title="Déconnexion">Déconnexion</a></li>
            </ul>
        </li>
    </ul>
    <form class="navbar-form navbar-right" role="search">
        <div class="form-group">
            <input type="text" class="form-control form-rounded" placeholder="Rechercher...">
        </div>
    </form>';
    $imgtwitter = 'id="littlenavbar"';
}

//} else {


//}

require Config::get('view.paths') . 'navbar.view.php';