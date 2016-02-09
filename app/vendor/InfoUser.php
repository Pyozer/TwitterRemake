<?php
namespace App\Vendor;
use \PDO;
/**
 * Class InfoUser
 * Permet de gérer les données d'un utilisateur
 */
class InfoUser {

    private $db;
    /* Contient le pseudo de l'utilisateur */
    public $username;
    /* Contient l'ID de l'utilisateur */
    public $userid;
    /* Contient les données l'utilisateur */
    private $infos = array();
    private static $_instance = null;

    private function __construct($DB_con, $username) {
        /* On défini la bdd */
        $this->db = $DB_con;
        /* On stock le pseudo */
        $this->username = $username;
    }

    public static function getInstance($DB_con, $username, $reset = null) {

        if(is_null(self::$_instance) || !is_null($reset)) {
            self::$_instance = new InfoUser($DB_con, $username);
        }
        return self::$_instance;
    }

    /**
     * Récupère les infos de l'utilisateur
     */
    public function getInfo() {
        /* On récupère les info de l'utilisateur en fonction de son ID */
        $reqinfos = $this->db->prepare("SELECT * FROM users WHERE pseudo=:username OR id=:username LIMIT 1");
        $reqinfos->execute(array(
            'username' => $this->username
        ));
        $reqinfos->setFetchMode(PDO::FETCH_OBJ);
        $infos = $reqinfos->fetch();
        /* On stock les infos */
        $this->infos = $infos;
        /* On stock son ID */
        $this->userid = $infos->id;
        /* On retourne les infos sous forme d'objet */
        return $infos;

    }

    /**
     * Retourne le nombre de tweets postés par notre utilisateur
     */
    public function getNbrTweets() {
        $userid = $this->userid;
        /* On sélectionne les tweets qui ont pour auteur notre utilisateur */
        $getTweets = $this->db->prepare("SELECT t.id FROM tweets as t LEFT JOIN users as u ON t.auteur_id = u.id WHERE t.auteur_id=:userid");
        $getTweets->execute(array(
            'userid' => $userid
        ));
        /* On compte le nombre de résultat */
        $nbrTweets = $getTweets->rowCount();

        return $nbrTweets;
    }

    /**
     * Récupère le nombre de followers d'un utilisateur
     */
    public function getNbrFollowers() {
        $userid = $this->userid;
        /* On sélectionne les fois quelqu'un suit notre utilisateur  */
        $getFollowers = $this->db->prepare("SELECT f.user_exp FROM follow as f LEFT JOIN users as u ON f.user_dest = u.id WHERE f.user_dest=:userid");
        $getFollowers->execute(array(
            'userid' => $userid
        ));
        /* On compte le nombre de résultat */
        $nbrFollowers = $getFollowers->rowCount();

        return $nbrFollowers;
    }

    /**
     * Récupère le nombre de personne que suit un utilisateur
     */
    public function getNbrFollow() {
        $userid = $this->userid;
        /* On sélectionne les fois ou notre utilisateur en suit un autre */
        $getFollow = $this->db->prepare("SELECT f.user_exp FROM follow as f LEFT JOIN users as u ON f.user_exp = u.id WHERE f.user_exp=:userid");
        $getFollow->execute(array(
            'userid' => $userid
        ));
        /* On compte le nombre de résultat */
        $nbrFollow = $getFollow->rowCount();

        return $nbrFollow;
    }

    /**
     * Récupère le nombre de média (photos/video) postés par notre utilisateur
     */
    public function getNbrMedia() {
        $userid = $this->userid;
        /* On sélectionne les fois ou notre utilisateur a posté une photo ou vidéo */
        $getMedia = $this->db->prepare("SELECT media_tweet, auteur_id FROM tweets WHERE auteur_id=:userid AND media_tweet != ''");
        $getMedia->execute(array(
            'userid' => $userid
        ));
        /* On compte le nombre de résultat */
        $nbrMedia = $getMedia->rowCount();

        return $nbrMedia;
    }

    /**
     * Récupère les id que notre utilisateur follow
     */
    public function getUserIdFollow() {
        $userid = $this->userid;
        /* On sélectionne les id des utilisateurs qui ont été follow  */
        $getInfoFollow = $this->db->prepare("SELECT users.id FROM users LEFT JOIN follow ON follow.user_dest = users.id WHERE follow.user_exp=:userid");
        $getInfoFollow->execute(array(
            'userid' => $userid
        ));
        /* On compte le nombre de résultat */
        $InfoFollow = $getInfoFollow->fetchAll(PDO::FETCH_ASSOC);
        $allids = array();
        foreach($InfoFollow as $key => $value) {
            $allids[] = $value['id'];
        }
        return $allids;
    }

    /**
     * Modifie les informations d'un utilisateur
     * @param array $data
     * @return boolean
     */
    public function changeInfo($data = []) {
        if(is_null($this->userid)) {
            $info = $this->getInfo();
            $this->userid = $info->id;
        }
        /* Pour chaque donné envoyé on update la BDD */
        foreach($data as $key => $value) {
            $setinfos = $this->db->prepare("UPDATE users SET " . $key . "=:value WHERE id=:userid");
            $setinfos->execute(array(
                'value' => $value,
                'userid' => $this->userid
            ));
        }
        if(isset($data['pseudo'])) {
            $_SESSION['username'] = $data['pseudo'];
        }

        /* On retourne les infos sous forme d'objet */
        return true;

    }
}