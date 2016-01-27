<?php
use App\App;
use Core\Config;

require 'core/init.php';

//On défini le titre
App::setTitle('Inscription');

//On importe la vue
require Config::get('view.paths') . 'inscription.view.php';