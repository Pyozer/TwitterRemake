<?php
use App\App;
use Core\Config;
use App\Vendor\User;

require 'core/init.php';

//User::redirect('home.php');
//On défini le titre
App::setTitle('Accueil');
$id_page = "index";

//On importe la vue
require Config::get('view.paths') . 'index.view.php';