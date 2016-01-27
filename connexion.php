<?php
use App\App;
use Core\Config;

require 'core/init.php';

//On défini le titre
App::setTitle('Connexion');
$id_page = "login";

//On importe la vue
require Config::get('view.paths') . 'connexion.view.php';