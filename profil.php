<?php
use App\App;
use Core\Config;
use App\Vendor\InfoUser;
use App\Vendor\User;
use App\Vendor\Follow;

require 'core/init.php';

if(!connect()) {
    User::redirect('/home.php');
}

//On défini le titre
App::setTitle('Profil');
$id_page = "profil";

/* Si le profil selectionné n'est pas le notre */
if(isset($_GET['user']) && $_GET['user'] != $_SESSION['username']) {
    $profil_userid = $_GET['user'];
    $profil_user = InfoUser::getInstance($DB_con, $profil_userid);
} else { /* Sinon si c'est le notre */
    $profil_user = InfoUser::getInstance($DB_con, $_SESSION['username']);
}
/* On récupère ensuite les infos */
$info_profil = $profil_user->getInfo();

$follow = Follow::getInstance($DB_con, $info_profil->id);
if(isset($_POST['SubmitFollow'])) {
    $UserToFollow = htmlspecialchars(trim($_POST['ProfilUserid']));
    if(!empty($UserToFollow)) {
        $follow->Follow();
    }
}
if(isset($_POST['SubmitUnFollow'])) {
    $UserToFollow = htmlspecialchars(trim($_POST['ProfilUserid']));
    if(!empty($UserToFollow)) {
        $follow->UnFollow();
    }
}

$nbrTweets = $profil_user->getNbrTweets();
$nbrFollowers = $profil_user->getNbrFollowers();
$nbrFollow = $profil_user->getNbrFollow();
$nbrMedia = $profil_user->getNbrMedia();

$user = User::getInstance($DB_con);
$imgprofil = $user->getUserImg($info_profil->id);
$banniere = $info_profil->banniere;

//On importe la vue
require Config::get('view.paths') . 'profil.view.php';