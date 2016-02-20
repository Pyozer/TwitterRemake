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
    /* Contient l'ID de l'utilisateur */
    public $userid;

    protected function __construct($DB_con, $userid) {
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
     * @return $alltweets array
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
     * Récupère tous les tweets des utilisateurs qu'il suit
     * @return $alltweets array
     */
    public function getAllTweets() {
        /* On récupère les ID que notre user follow */
        $user = InfoUser::getInstance($this->db, $this->userid);
        $allid = $user->getUserIdFollow();
        /* On ajoute notre ID à la liste */
        $allid[] = $this->userid;
        /* On selectionne tous les tweets appartement à la liste des ID */
        $getTweets = $this->db->prepare("SELECT t.*, u.id as user_id, u.pseudo, u.nom, u.prenom FROM tweets as t LEFT JOIN users as u ON t.auteur_id = u.id WHERE auteur_id REGEXP(:ids) ORDER BY date DESC");
        $getTweets->execute(array(
            'ids' => implode('|', $allid)
        ));
        $getTweets->setFetchMode(PDO::FETCH_OBJ);
        $alltweets = $getTweets->fetchAll();
        /* On retourne les tweets */
        return $alltweets;
    }

    public function getNbrFav($id_tweet) {
        $getNbrFav = $this->db->prepare("SELECT * FROM tweet_fav WHERE tweet_id=:id_tweet");
        $getNbrFav->execute(array(
            "id_tweet" => $id_tweet
        ));
        $nbr_fav = $getNbrFav->rowCount();
        return $nbr_fav;
    }

    public function getNbrReply($id_tweet) {
        $getNbrReply = $this->db->prepare("SELECT id FROM tweets WHERE reply_to=:id_tweet");
        $getNbrReply->execute(array(
            "id_tweet" => $id_tweet
        ));
        $nbr_reply = $getNbrReply->rowCount();
        return $nbr_reply;
    }
}