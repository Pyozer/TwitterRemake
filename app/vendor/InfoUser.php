<?php
namespace App\Vendor;

use \PDO;
/**
 * Class InfoUser
 * Permet de gérer les données d'un utilisateur
 */
class InfoUser {

    private $db;
    public $username;
    private static $_instance = null;

    private function __construct($DB_con, $username) {
        /* On défini la bdd */
        $this->db = $DB_con;
        /* On défini le pseudo ou id de l'utilisateur */
        $this->username = $username;
    }

    public static function getInstance($DB_con, $username) {
        if(is_null(self::$_instance)) {
            self::$_instance = new InfoUser($DB_con, $username);
        }
        return self::$_instance;
    }

    /**
     * Récupère les infos de l'utilisateur
     */
    public function getInfo() {
        /* On récupère les info de l'utilisateur en fonction de son pseudo / ID */
        $reqinfos = $this->db->prepare("SELECT * FROM users WHERE pseudo=:username OR id=:username LIMIT 1");
        $reqinfos->execute(array(
            'username' => $this->username
        ));
        $reqinfos->setFetchMode(PDO::FETCH_OBJ);
        $infos = $reqinfos->fetch();
        /* On retourne les infos sous forme d'objet */
        return $infos;

    }
}