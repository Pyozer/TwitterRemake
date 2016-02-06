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

    public function AddTweet($tweet, $media = null) {
        //Ajout du tweet à la BDD
    }

}