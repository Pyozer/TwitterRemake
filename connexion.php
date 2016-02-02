<?php
use App\App;
use App\Vendor\User;
use Core\Config;

require 'core/init.php';

if(connect()) {
    User::redirect('/');
}
//On défini le titre
App::setTitle('Connexion');
$id_page = "login";

$user = User::getInstance($DB_con);

if(isset($_POST['SubmitButton'])) {
    $errors = null;
    $encoding = 'utf-8';
    $username = htmlspecialchars(trim($_POST['InputUsername']), ENT_QUOTES, $encoding);
    $password = htmlspecialchars(trim($_POST['InputPassword']), ENT_QUOTES, $encoding);
    if(!$stayonline = htmlspecialchars($_POST['InputStayOnline'])) {
        $stayonline = null;
    }
    /* On vérifie que tous les champs sont saisies */
    if(empty($username) || empty($password)) {
        $errors['FieldsEmpty'] = "Veuillez saisir tous les champs de texte";
    }
    /* On vérifie qu'il n'y a pas d'erreurs */
    if($errors) {
        $allerror = "<ul>";
        foreach ($errors as $key) {
            $allerror .= "<li>" . $key . "</li>";
        }
        $allerror .= "</ul>";
        setFlash($allerror, "danger");
    } else {
        if($user->login($username, $password, $stayonline)) {
            User::redirect('/');
        } else {
            setFlash("Identifiant ou mot de passe incorrect :/", "danger");
        }
    }
}

//On importe la vue
require Config::get('view.paths') . 'connexion.view.php';