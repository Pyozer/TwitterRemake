<?php
use App\App;
use Core\Config;

require 'core/init.php';

//On défini le titre
App::setTitle('Inscription');
$id_page = "register";

//On importe la vue
require Config::get('view.paths') . 'inscription.view.php';