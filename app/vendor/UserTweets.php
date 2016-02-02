<?php
namespace App\Vendor;

/**
 * Class Tweets
 * Permet de gérer les différentes relation Utilisateur / Tweets
 */
class UserTweets extends Tweets {

    public static function getInstance($DB_con, $userid) {
        if(is_null(self::$_instance)) {
            self::$_instance = new UserTweets($DB_con, $userid);
        }
        return self::$_instance;
    }

    /**
     * Récupère le nombre de tweets posté par notre utilisateur
     */
    public function getNbrTweets() {
        $userid = $this->userid;
        /* On sélectionne les tweets qui ont pour auteur notre utilisateur */
        $getTweets = $this->db->prepare("SELECT t.id FROM tweets as t LEFT JOIN users as u ON t.auteur_id = u.id WHERE t.auteur_id=:userid");
        $getTweets->execute(array(
            'userid' => $userid
        ));
        /* On compte le nombre de résultat */
        $nbrtweets = $getTweets->rowCount();

        return $nbrtweets;
    }
}