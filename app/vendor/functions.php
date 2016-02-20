<?php
/*
|--------------------------------------------------------------------------
| Toutes les fonctions utilisés
|--------------------------------------------------------------------------
| Fichier contenant toutes les fonctions simple
| Possibilité d'être appelé partout
*/
use Upload\File;
use Upload\Storage\FileSystem;
use Upload\Validation\Mimetype;
use Upload\Validation\Size;

/**
 * Vérifie si un utilisateur est connecté
 * @return bool
 */
function connect() {
    if(isset($_SESSION['session'])) {
        return true;
    } else {
        return false;
    }
}
/**
 * Défini dans une variable $_SESSION une erreur
 * @param $message
 * @param string $type
 */
function setFlash($message, $type = 'success') {
    $_SESSION['Flash'] = $message;
    $_SESSION['Flash_Type'] = $type;
}

/**
 * Affiche l'erreur sauvegarder au paravent
 */
function flash(){
    if(isset($_SESSION['Flash'])){
        $message = $_SESSION['Flash'];
        $type = $_SESSION['Flash_Type'];
        echo "<div class='alert alert-$type'><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>$message</div>";
        unset($_SESSION['Flash_Type']);
        unset($_SESSION['Flash']);
    }
}

/**
 * Permet de hasher un mot de passe
 * @param $passwordtohash
 * @return bool|string
 */
function passwordhash($passwordtohash)
{
    $options = [
        'cost' => 9,
        'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    ];
    $passwordhashed = password_hash($passwordtohash, PASSWORD_BCRYPT, $options);
    return $passwordhashed;
}

/**
 * Check si une chaine de caractère possède seulement des lettres (& accents)
 * @param $text
 * @return bool
 */
function only_letters($text) {
    preg_match('#^[a-zA-Zéèïüë -]{1,30}$#', $text, $tab5);
    return (count($tab5) != 0);
}


/**
 * Formate une date pour les tweets"
 * @param $date
 * @return string
 */
function AffDate($date){
    /* Si la date n'est pas un entier */
    if(!ctype_digit($date)) {
        $date = strtotime($date);
    }
    /* Si la date correspond à aujourd'hui */
    if(date('Ymd', $date) == date('Ymd')) {
        $diff = time() - $date;

        if($diff < 60) { /* Moins d'une minute */
            return '1 min';
        } elseif($diff < 3600) { /* Moins d'une heure */
            return round($diff/60, 0) . ' min';
        } elseif($diff >= 3600) { /* Une heure ou plus */
            return round($diff/3600, 0) . ' h';
        }
    } elseif(date('Ymd', $date) == date('Ymd', strtotime('- 1 DAY'))) { /* Date d'hier */
        return '1 jours';
    } elseif(date('Ymd', $date) == date('Ymd', strtotime('- 2 DAY'))) { /* Date d'il y a 2 jours */
        return '2 jours';
    } else { /* + de 2 jours */
        return date('d/m', $date);
    }
}

/*
 * Sauvegarde une image de tpye base64 (string)
 * vers un fchier jpeg
 */
function base64_to_png($base64_string, $name_file, $dirtosave = "/img/profils/") {
    $img = $base64_string;
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = ROOT . $dirtosave . $name_file . '.png';
    $success = file_put_contents($file, $data);
    print $success ? $file : 'Unable to save the file.';
}

/*
 * Récupère l'erreur possible lors d'un upload
 */
function UploadingException($error) {
    switch ($error) {
        case UPLOAD_ERR_OK:
            $message = "There is no error, the file uploaded with success";
            break;
        case UPLOAD_ERR_INI_SIZE:
            $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
            break;
        case UPLOAD_ERR_FORM_SIZE:
            $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
            break;
        case UPLOAD_ERR_PARTIAL:
            $message = "The uploaded file was only partially uploaded";
            break;
        case UPLOAD_ERR_NO_FILE:
            $message = "No file was uploaded";
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            $message = "Missing a temporary folder";
            break;
        case UPLOAD_ERR_CANT_WRITE:
            $message = "Failed to write file to disk";
            break;
        case UPLOAD_ERR_EXTENSION:
            $message = "File upload stopped by extension";
            break;
        default:
            $message = "Unknown upload error";
            break;
    }
    return $message;
}