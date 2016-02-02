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
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
$user = InfoUser::getInstance($DB_con, $username);
$infouser = $user->getInfo();

$usertweet = \App\Vendor\UserTweets::getInstance($DB_con, $userid);
$nbrTweets = $usertweet->getNbrTweets();

//On importe la vue
require Config::get('view.paths') . 'index.view.php';