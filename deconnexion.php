<?php
use App\App;
use App\Vendor\User;
use Core\Config;

require 'core/init.php';

/* On déconnecte l'utilisateur */
User::logout();

//On défini le titre
App::setTitle('Déconnexion');
$id_page = "logout";

//On importe la vue
require Config::get('view.paths') . 'deconnexion.view.php';