<?php
namespace App\Vendor;

/**
 * Class Follow
 * Permet de gérer les Follow, unFollow etc..
 */
class Follow {

    private $db;
    private static $_instance = null;

    private function __construct($DB_con, $UserToFollow) {
        $this->db = $DB_con;
        $this->UserToFollow = $UserToFollow;
    }

    public static function getInstance($DB_con, $UserToFollow) {
        if(is_null(self::$_instance)) {
            self::$_instance = new Follow($DB_con, $UserToFollow);
        }
        return self::$_instance;
    }

    public function Follow() {
        $ReqFollow = $this->db->prepare("INSERT INTO follow (user_exp, user_dest) VALUES (:user_exp, :user_dest)");
        $ReqFollow->execute(array(
            "user_exp" => $_SESSION['userid'],
            "user_dest" => $this->UserToFollow
        ));
        return true;
    }

    public function UnFollow() {
        $ReqUnFollow = $this->db->prepare("DELETE FROM follow WHERE user_exp=:user_exp AND user_dest=:user_dest");
        $ReqUnFollow->execute(array(
            "user_exp" => $_SESSION['userid'],
            "user_dest" => $this->UserToFollow
        ));
        return true;
    }

    public function checkFollow() {
        $CheckFollow = $this->db->prepare("SELECT * FROM follow WHERE user_exp=:user_exp AND user_dest=:user_dest LIMIT 1");
        $CheckFollow->execute(array(
            "user_exp" => $_SESSION['userid'],
            "user_dest" => $this->UserToFollow
        ));

        if($CheckFollow->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}