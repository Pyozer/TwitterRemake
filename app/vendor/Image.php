<?php
namespace App\Vendor;

use Core\Config;

class Image {

    private $db;
    private static $_instance = null;

    private function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public static function getInstance($DB_con) {
        if(is_null(self::$_instance)) {
            self::$_instance = new Image($DB_con);
        }
        return self::$_instance;
    }


    /**
     * @param $namefile - Upload une image en vérifiant différents paramètres
     * @param null $dir
     * @param int $max_size
     * @return array
     */
    public static function upload_img($namefile, $dir = null, $max_size = 5242880) {
        // Si le chemin n'est pas spécifié
        if(!isset($dir)) {
            $dir = Config::get('image.imgprofil_path');
        }
        // Constantes
        define('TARGET', ROOT . $dir);      // Repertoire cible
        define('MAX_SIZE', $max_size);      // Taille max en octets du fichier

        // Tableaux de donnees
        $tabExt = array('jpg','gif','png','jpeg');      //Extension autorisé
        $mimetype = array('image/png', 'image/jpeg', 'image/gif');

        //Variables
        $errors = array();
        $allerror = array();

        // On verifie si le champ est rempli
        if(!empty($_FILES[$namefile]['name'])) {
            // Recuperation de l'extension du fichier
            $extension  = pathinfo($_FILES[$namefile]['name'], PATHINFO_EXTENSION);

            // On verifie l'extension du fichier
            if(!in_array(strtolower($extension), $tabExt) || !in_array($_FILES[$namefile]['type'], $mimetype)) {
                $errors['ExtWrong'] = "Le fichier n'est pas une image (png, jpg, jpeg ou gif)";
            }
            // On verifie le type de l'image
            if(!getimagesize($_FILES[$namefile]['tmp_name'])) {
                $errors['ImageSize'] = "Erreur dans les dimensions de l'image";
            }
            // On verifie la taille du fichier
            if(filesize($_FILES[$namefile]['tmp_name']) > MAX_SIZE || $_FILES[$namefile]['size'] > MAX_SIZE) {
                $errors['SizeWrong'] = "L'image ne doit pas faire plus de 5 Mo";
            }
            // Parcours du tableau d'erreurs
            if(!isset($_FILES[$namefile]['error']) && UPLOAD_ERR_OK !== $_FILES[$namefile]['error']) {
                $errors['ImgError'] = "Une erreur interne a empêché l'upload de l'image :/";
            }

            /* Si il y a eu des erreurs on les retournes, sinon on continu */
            if($errors) {
                foreach ($errors as $key) {
                    $allerror[] = $key;
                }
                return $allerror;
            } else {
                // On renomme le fichier (Ajout d'uniqid pour éviter problème de cache)
                $nomImage = $_SESSION['userid'] . "=" . uniqid() . "." . strtolower($extension);
                // Si c'est OK, on teste l'upload
                if(move_uploaded_file($_FILES[$namefile]['tmp_name'], TARGET.$nomImage)) {
                    // On supprime la valeur de la session Imgprofil
                    unset($_SESSION['imgprofil']);
                    // On retourne le nom de l'image
                    return array('status' => 1, 'imgname' => $nomImage);
                } else {
                    // Sinon on retourne une erreur
                    $lasterror = array("ErrorMove" => "Problème lors de l'upload ! Réessayez.");
                    return $lasterror;
                }
            }
        }
    }


    /**
     * @param $filename - Supprime une image (fichier)
     * @param null $dir
     * @return bool
     */
    public static function delete($filename, $dir = null) {
        // Si le chemin n'est pas spécifié
        if(!isset($dir)) {
            $dir = Config::get('image.imgprofil_path');
        }
        $fullpath = ROOT . $dir . $filename;
        // On vérifie que le fichier existe
        if(file_exists($fullpath)) {
            // On supprime ensuite le fichier
            if(unlink($fullpath)) {
                return true;
            }
        }
    }
}