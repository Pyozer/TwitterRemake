<?php
namespace App\Vendor;

use Core\Config;
use \PDO;
/**
 * Class User
 * Permet de gérer les inscription, connexion d'un utilisateur
 */
class User {

    private $db;
    private static $_instance = null;

    private function __construct($DB_con) {
        $this->db = $DB_con;
    }

    public static function getInstance($DB_con) {
        if(is_null(self::$_instance)) {
            self::$_instance = new User($DB_con);
        }
        return self::$_instance;
    }

    /**
     * Enregistre un utilisateur à la base de donnée
     * @param $pseudo string
     * @param $prenom string
     * @param $nom string
     * @param $email string
     * @param $password string
     * @return bool
     */
    public function register($pseudo, $prenom, $nom, $email, $password, $imgname) {
        /* On hash le mot de passe */
        $passwordhashed = passwordhash($password);
        /* On défini la date d'inscription */
        $dateinscription = date('Y-m-d');
        $lastco = date("Y-m-d H:i:s");

        $registeruser = $this->db->prepare("INSERT INTO users (pseudo, nom, prenom, email, password, imgprofil, dateinscription, lastco) VALUES(:pseudo, :nom, :prenom, :email, :password, :imgprofil, :dateinscription, :lastco)");
        $registeruser->execute(array(
            'pseudo' => $pseudo,
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'password' => $passwordhashed,
            'imgprofil' => $imgname,
            'dateinscription' => $dateinscription,
            'lastco' => $lastco
        ));
        return true;
    }

    /**
     * Connecte un utilisateur grâce à son email/pseudo et mot de passe
     * @param $username string
     * @param $password string
     * @param $stayonline null
     * @return bool
     */
    public function login($username, $password, $stayonline = null) {
        /* Récupère les infos de l'utilisateur en fonction de son email / pseudo */
        $checkinfo = $this->db->prepare("SELECT * FROM users WHERE email=:username OR pseudo=:username LIMIT 1");
        $checkinfo->execute(array(
            'username'=> $username
        ));
        /* On stock les infos sous forme d'objet */
        $userRow = $checkinfo->fetch(PDO::FETCH_OBJ);
        /* On vérifie que l'utilisateur existe */
        if($checkinfo->rowCount() > 0) {
            /* On vérifie que le mot de passe entré correspond */
            if(password_verify($password, $userRow->password)) {
                /* On généère une clé aléatoire */
                $session = sha1(md5(rand()));
                /* On défini la dernière connexion à maintenant */
                $lastco = date("Y-m-d H:i:s");
                /* On update les infos sur la BDD */
                $updateMembre = $this->db->prepare('UPDATE users SET session=:session, lastco=:lastco WHERE email=:username OR pseudo=:username');
                $updateMembre->execute(array(
                    'username' => $username,
                    'session' => $session,
                    'lastco' => $lastco
                ));
                /* On défini les variable session necessaire */
                $_SESSION['session'] = $session;
                $_SESSION['userid'] = $userRow->id;
                $_SESSION['userprenom'] = $userRow->prenom;
                $_SESSION['usernom'] = $userRow->nom;
                $_SESSION['username'] = $userRow->pseudo;
                /* Si la checkbox "gardé la connexion" est coché, on défini un cookie */
                if($stayonline != null) {
                    $contentcook = $userRow->id."===".sha1($username.$_SERVER['REMOTE_ADDR']);
                    $tempcookie = time() + 3600 * 24 * 31;
                    setcookie('auth', $contentcook, $tempcookie, '/', Config::get('app.url'), false, true);
                }
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @param $email - Vérifie si l'email n'a pas déjà été utilisé
     * @return true ou false
     */
    public function checkemail($email) {
        $checkemail = $this->db->prepare("SELECT email FROM users WHERE email=:email");
        $checkemail->execute(array(
            'email' => $email
        ));
        if($checkemail->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $pseudo string - Vérifie si le pseudo n'a pas déjà été utilisé
     * @return bool
     */
    public function checkpseudo($pseudo) {
        $checkpseudo = $this->db->prepare("SELECT pseudo FROM users WHERE pseudo=:pseudo");
        $checkpseudo->execute(array(
            'pseudo' => $pseudo
        ));
        if($checkpseudo->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Vérifie si le mot de passe actuel d'un utilisateur est valide
     * @param $iduser string
     * @param $password string
     * @return bool
     */
    public function checkpassword($iduser, $password) {
        /* Récupère le mot de passe de l'utilisateur en fonction de son id */
        $getpassword = $this->db->prepare("SELECT password FROM users WHERE id=:userid LIMIT 1");
        $getpassword->execute(array(
            'userid'=> $iduser
        ));
        /* On vérifie que l'utilisateur existe */
        if($getpassword->rowCount() > 0) {
            /* On stock le mdp sous forme d'objet */
            $userInfo = $getpassword->fetch(PDO::FETCH_OBJ);
            /* On vérifie que le mot de passe entré correspond */
            if(password_verify($password, $userInfo->password)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @param $pseudo string - Renvoi l'id de l'utilisateur
     * @return bool
     */
    public function getUserid($pseudo) {
        $getid = $this->db->prepare("SELECT id FROM users WHERE pseudo=:pseudo");
        $getid->execute(array(
            'pseudo' => $pseudo
        ));
        if($getid->rowCount() > 0) {
            $iduser = $getid->fetch(PDO::FETCH_OBJ);
            return $iduser->id;
        } else {
            return false;
        }
    }

    /**
     * Renvoi l'image de profil d'un utilisateur
     * @param $userid string
     * @return string
     */
    public function getUserImg($userid) {
        // Chemin d'accès des photos de profils
        $dir = Config::get('image.imgprofil_path');
        // On récupère la valeur de l'img dans la BDD
        $getimgname = $this->db->prepare("SELECT imgprofil, pseudo FROM users WHERE id=:id LIMIT 1");
        $getimgname->execute(array(
            'id' => $userid
        ));
        $data = $getimgname->fetch(PDO::FETCH_OBJ);
        // On défini le nom de l'image généré à l'inscription
        $imgnamealea = $data->pseudo . ".png";
        // Si il y a un résultat
        if($getimgname->rowCount() > 0) {
            // On vérifie que le résultat n'est pas vide
            if(!empty($data->imgprofil)) {
                $imgsqlname = $data->imgprofil;

                $filename = $dir . $imgsqlname;
                // On vérifie que l'image existe
                if(file_exists(ROOT . $filename)) {
                    return $filename;
                } elseif(file_exists(ROOT . $dir . $imgnamealea)) { // Sinon on vérifie que l'image généré à l'inscription existe
                    return $dir . $imgnamealea;
                } else { // Sinon on renvoi l'image par defaut
                    return $dir . 'profil_default.png';
                }
            } else {
                if(file_exists(ROOT . $dir . $imgnamealea)) { // On vérifie que l'image généré à l'inscription existe
                    return $dir . $imgnamealea;
                } else {
                    return $dir . 'profil_default.png';
                }
            }
        } else {
            return $dir . 'profil_default.png';
        }
    }

    /**
     * Redirige un utilisateur vers l'url demandé
     * @param $url string
     */
    public static function redirect($url) {
        header('Location: ' . $url);
        exit;
    }

    /**
     * Déconnecte l'utilisateur
     * @return bool
     */
    public static function logout() {
        /* On détruit toutes les variables de $_SESSION */
        $_SESSION = null;
        unset($_SESSION);
        session_destroy();
        setcookie('auth', '', time() - 3600 * 24, '/', Config::get('app.url'), false, true);
        return true;
    }
}