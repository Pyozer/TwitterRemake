<?php
use App\App;
use App\Vendor\User;
use Core\Config;
use Identicon\Identicon;

require 'core/init.php';

if(connect()) {
    User::redirect('/');
}
//On défini le titre
App::setTitle('Inscription');
$id_page = "register";

/*
 * On défini un nouvelle objet user
 */
$user = User::getInstance($DB_con);

/* Si on valide le formulaire */
if(isset($_POST['submitRegister'])) {
    $errors = array();
    $pseudo = htmlspecialchars(trim($_POST['InputPseudo']), ENT_QUOTES);
    $prenom = htmlspecialchars(trim($_POST['InputPrenom']), ENT_QUOTES);
    $nom = htmlspecialchars(trim($_POST['InputNom']), ENT_QUOTES);
    $email = htmlspecialchars(trim($_POST['InputEmail']), ENT_QUOTES);
    $email = mb_strtolower($email);
    $password = htmlspecialchars(trim($_POST['InputPassword']), ENT_QUOTES);
    $confirmpassword = htmlspecialchars(trim($_POST['InputPassword2']), ENT_QUOTES);

    /* On vérifie que tous les champs ont bien été saisis */
    if(empty($pseudo) || empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($confirmpassword)) {
        $errors['EmptyFields'] = "Veuillez remplir tous les champs de texte";
    }
    /* On vérifie que les mot de passe sont identiques */
    if($password != $confirmpassword) {
        $errors['SamePwd'] = "La confirmation du mot de passe est incorrect";
    }
    /* On vérifie la syntaxe de l'adresse mail et que l'email n'est pas utilisé */
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['EmailFalse'] = "Le format de votre adresse mail est incorrect (ex: mail@exemple.fr )";
    } else {
        if($user->checkemail($email) == true) {
            $errors['EmailTaken'] = "L'adresse mail saisie est déjà utilisé";
        }
    }
    /* On vérifie que le prénom et nom sont uniquement des lettres */
    if(!only_letters($nom) || !only_letters($prenom)) {
        $errors['NameNoLetters'] = "Votre prénom et nom doivent contenir seulement des lettres";
    }
    /* On vérifie que le mot de passe fasse plus que 5 caractères */
    if(strlen(utf8_decode($password)) < 5 || strlen(utf8_decode($confirmpassword)) < 5) {
        $errors['PasswordLength'] = "Votre mot de passe doit au moins contenir 6 caractères";
    }
    /* On vérifie que le pseudo n'est pas déjà pris */
    if($user->checkpseudo($pseudo) == true) {
        $errors['PseudoTaken'] = "Le pseudo saisie est déjà utilisé";
    }

    /* Si il y a eu des erreurs on les affiche, sinon on continu l'inscription */
    if($errors) {
        $allerror = "<ul>";
        foreach ($errors as $key) {
            $allerror .= "<li>" . $key . "</li>";
        }
        $allerror .= "</ul>";
        setFlash($allerror, "danger");
    } else {
        /* On commence l'inscription */
        $nom = ucwords(mb_strtolower($nom, 'UTF-8'));
        $prenom = ucwords(mb_strtolower($prenom, 'UTF-8'));

        /* On lui génère une image de profil */
        $identicon = new Identicon();
        $imageDataUri = $identicon->getImageDataUri($pseudo);
        base64_to_png($imageDataUri, $pseudo);
        $imgname = $pseudo . ".png";
        /* On enregistre notre utilisateur */
        if($user->register($pseudo, $prenom, $nom, $email, $password, $imgname)) {
            /* Si l'inscription a bien eu lieu, on le connecte */
            $user->login($pseudo, $password);
            /* On rédirige l'utilisateur à l'index */
            $user::redirect('/');
        } else {
            setFlash("Une erreur est survenur lors de votre inscription :/", "danger");
        }
    }
}

//On importe la vue
require Config::get('view.paths') . 'inscription.view.php';