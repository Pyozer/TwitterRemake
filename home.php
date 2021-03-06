<?php
use App\App;
use Core\Config;
use App\Vendor\User;

require 'core/init.php';

if(connect()) {
    User::redirect('/');
}

//On défini le titre
App::setTitle('Accueil');
$title_site = Config::get('app.title');
//On importe la vue
require Config::get('view.paths') . 'home.view.php';