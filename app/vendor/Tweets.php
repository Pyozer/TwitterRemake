<?php
namespace App\Vendor;

use \PDO;
/**
 * Class Tweets
 * Permet de gérer les tweets
 */
class Tweets {

    protected $db;
    protected static $_instance = null;
    public $userid = "";

    protected function __construct($DB_con, $userid) {
        /* On défini la bdd */
        $this->db = $DB_con;
        $this->userid = $userid;
    }

    public static function getInstance($DB_con, $userid) {
        if(is_null(self::$_instance)) {
            self::$_instance = new Tweets($DB_con, $userid);
        }
        return self::$_instance;
    }


    /**
     * Récupère tous les tweets d'un utilisateur
     */
    public function getUserTweets() {
        $userid = $this->userid;

        $getTweets = $this->db->prepare("SELECT t.*, u.id, u.pseudo, u.nom, u.prenom FROM tweets as t LEFT JOIN users as u ON t.auteur_id = u.id WHERE auteur_id=:userid ORDER BY date DESC");
        $getTweets->execute(array(
            'userid' => $userid
        ));
        $getTweets->setFetchMode(PDO::FETCH_OBJ);
        $alltweets = $getTweets->fetchAll();

        return $alltweets;
    }

    /**
     * Récupère tous les tweets pour le fils d'actualité
     */
    public function getTweets() {
        $userid = $this->userid;

        $getTweets = $this->db->prepare("SELECT t.*, u.id, u.pseudo, u.nom, u.prenom FROM tweets as t LEFT JOIN users as u ON t.auteur_id = u.id WHERE auteur_id=:userid");
        $getTweets->execute(array(
            'userid' => $userid
        ));
        $getTweets->setFetchMode(PDO::FETCH_OBJ);
        $alltweets = $getTweets->fetchAll();

        return $alltweets;
    }
}