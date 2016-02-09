<?php
use App\App;
use Core\Config;
use App\Vendor\InfoUser;
use App\Vendor\User;
use App\Vendor\Image;

require 'core/init.php';

if(!connect()) {
    User::redirect('/home.php');
}

//On défini le titre
App::setTitle('Modification profil');
$id_page = "edit-profil";

$profil_user = InfoUser::getInstance($DB_con, $_SESSION['username']);
$user = User::getInstance($DB_con);

/* On récupère ensuite les infos */
$info_profil = $profil_user->getInfo();
$bio = $info_profil->bio;

/*
 * Si on valide le formulaire sur le profil
 */
if(isset($_POST['SubmitProfil'])) {
    $errors = array();
    $data = array();
    $bio = htmlspecialchars(trim($_POST['inputBio']));
    $imgprofil = $_FILES['inputImg'];
    /* Si la bio a été modifié et fait ne fait pas plus de 160 caractères */
    if($bio != $info_profil->bio) {
        if(strlen(utf8_decode($bio)) > 160) {
            $errors['LengthBio'] = "Votre bio ne doit pas faire plus de 160 caractères";
        } else {
            /* On stock la valeur de la nouvelle bio */
            $data['bio'] = $bio;
        }
    }
    /* Si une image de profil a été mise */
    if(isset($_FILES['inputImg']['name']) && !empty($_FILES['inputImg']['name'])) {
        $uploadfile = Image::upload_img('inputImg');
        if($uploadfile['status'] == 1) {
            /* On supprime l'ancienne image */
            Image::delete($info_profil->imgprofil);
            /* On stock la valeur de la nouvelle img */
            $data['imgprofil'] = $uploadfile['imgname'];
        } else {
            foreach($uploadfile as $key) {
                $errors[] = $key;
            }
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

//On importe la vue
require Config::get('view.paths') . 'edit-profil.view.php';