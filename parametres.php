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
App::setTitle('Paramètres');
$id_page = "parametres";

$profil_user = InfoUser::getInstance($DB_con, $_SESSION['username']);
$user = User::getInstance($DB_con);

/* On récupère ensuite les infos */
$info_profil = $profil_user->getInfo();
$email = $info_profil->email;
$pseudo = $info_profil->pseudo;

/*
 * Si on valide le formulaire sur le profil
 */
if(isset($_POST['SubmitProfil'])) {
    $errors = array();
    $data = array();
    $pseudo = htmlspecialchars(trim($_POST['inputUsername']));
    $email = htmlspecialchars(trim($_POST['inputEmail']));
    /* Si un des deux champs est vide */
    if(empty($pseudo) || empty($email)) {
        $errors['EmptyInput'] = "Veuillez remplir tous les champs de texte";
    }
    /* Si l'adresse mail a été modifié
     * On vérifie la syntaxe de l'adresse mail et que l'email n'est pas utilisé
     */
    if($email != $info_profil->email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['EmailFalse'] = "Le format de votre adresse mail est incorrect (ex: mail@exemple.fr )";
        } else {
            if ($user->checkemail($email) == true) {
                $errors['EmailTaken'] = "L'adresse mail saisie est déjà utilisé";
            } else {
                $data['email'] = $email;
            }
        }
    }
    /* Si le pseudo a été modifié
     * On vérifie que le pseudo n'est pas utilisé
     */
    if($pseudo != $info_profil->pseudo) {
        if($user->checkpseudo($pseudo) == true) {
            $errors['UserTaken'] = "Le pseudo saisie est déjà utilisé";
        } else {
            $data['pseudo'] = $pseudo;
        }
    }
    /* Si il y a eu des erreurs on les affiches, sinon on fait les modifications */
    if($errors) {
        $allerror = "<ul>";
        foreach ($errors as $key) {
            $allerror .= "<li>" . $key . "</li>";
        }
        $allerror .= "</ul>";
        setFlash($allerror, "danger");
    } else {
        if(!empty($data)) {
            if($profil_user->changeInfo($data)) {
                setFlash("Les modifications ont bien été faite", "success");
            } else {
                setFlash("Les modifications ont échoués", "danger");
            }
        } else {
            setFlash("Vous n'avez rien changé !", "warning");
        }
    }
}
/*
 * Si on valide le formulaire pour changer de mot de passe
 */
if(isset($_POST['SubmitPassword'])) {
    $errors = array();
    $data = array();
    $actualpswd = htmlspecialchars(trim($_POST['inputPassword']));
    $newpswd = htmlspecialchars(trim($_POST['inputNewPassword']));
    $newpswd2 = htmlspecialchars(trim($_POST['inputNewPassword2']));
    /* On hash le mot de passe */
    $passwordhash = passwordhash($newpswd);

    /* Si un des trois champs est vide */
    if(empty($actualpswd) || empty($newpswd) || empty($newpswd2)) {
        $errors['EmptyInput'] = "Veuillez remplir tous les champs de texte";
    }
    /* On vérifie que le mot de passe actuel est correct */
    if($actualpswd != $user->checkpassword($info_profil->id, $actualpswd)) {
            $errors['PasswordFalse'] = "Le mot de passe actuel est incorrect !";
    }
    /* Si les nouveaux mot de passe ne sont pas idéntique */
    if($newpswd != $newpswd2) {
        $errors['PswdNotSame'] = "La confirmation de votre nouveau mot de passe ne correspond pas";
    }
    /* On vérifie que le nouveau mot de passe n'est pas le même que l'actuel */
    if($actualpswd == $user->checkpassword($info_profil->id, $newpswd)) {
        $errors['PasswordSame'] = "Vous n'avez pas changer de mot de passe";
    }
    /* On vérifie que le mot de passe fasse plus que 5 caractères */
    if(strlen(utf8_decode($newpswd)) < 5 || strlen(utf8_decode($newpswd2)) < 5) {
        $errors['PasswordLength'] = "Votre mot de passe doit au moins contenir 6 caractères";
    }

    /* Si il y a eu des erreurs on les affiches, sinon on fait les modifications */
    if($errors) {
        $allerror = "<ul>";
        foreach ($errors as $key) {
            $allerror .= "<li>" . $key . "</li>";
        }
        $allerror .= "</ul>";
        setFlash($allerror, "danger");
    } else {
        $data['password'] = $passwordhash;
        if(!empty($data)) {
            if($profil_user->changeInfo($data)) {
                setFlash("Les modifications ont bien été faite", "success");
            } else {
                setFlash("Les modifications ont échoués", "danger");
            }
        } else {
            setFlash("Vous n'avez rien changé !", "warning");
        }
    }
}
//On importe la vue
require Config::get('view.paths') . 'parametres.view.php';