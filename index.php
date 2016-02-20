<?php
use App\App;
use Core\Config;
use App\Vendor\InfoUser;
use App\Vendor\User;

require 'core/init.php';

if(!connect()) {
    User::redirect('/home.php');
}

//On défini le titre
App::setTitle('Accueil');
$id_page = "index";

/* On récupère les infos de l'utilisateur */
$user = InfoUser::getInstance($DB_con, $_SESSION['userid']);
$info_profil = $user->getInfo();
$nbrTweets = $user->getNbrTweets();
$nbrFollowers = $user->getNbrFollowers();
$nbrFollow = $user->getNbrFollow();
$nbrMedia = $user->getNbrMedia();

if(!isset($_SESSION['imgprofil'])) {
    $user = User::getInstance($DB_con);
    $_SESSION['imgprofil'] = $user->getUserImg($_SESSION['userid']);
}

//On importe la vue
require Config::get('view.paths') . 'index.view.php';