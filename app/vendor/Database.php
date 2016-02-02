<?php
namespace App\Vendor;

use Core\Config;
use \PDO;
/*
 * Class Database - Gère les connexions à la BDD
 */
class Database {

    # @object, The PDO object
    private $pdo;

    # @bool ,  Connected to the database
    private $bConnected = false;

    /**
     * Etablie la connexion à la BDD
     */
    public function __construct()
    {
        /*
         * Si la connexion n'a pas encore été établie on la fait
         */
        if(!$this->bConnected) {
            return $this->Connect();
        }
    }

    /**
     *	Permet de se connecter à la base de donnée
     */
    public function Connect()
    {
        /* On récupère les infos pour la connexion */
        $DB_host = Config::get('database.mysql.host');
        $DB_name = Config::get('database.mysql.database');
        $DB_user = Config::get('database.mysql.username');
        $DB_pass = Config::get('database.mysql.password');
        $dsn = 'mysql:dbname=' . $DB_name . ';host=' . $DB_host . '';
        /* On tente la connexion */
        try {
            $this->pdo = new PDO($dsn, $DB_user, $DB_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

            # On peut maintenant obtenir les erreurs si il y en a.
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            # Désactive l'émulation des instructions préparées, en utilise de vrai à la place.
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            # Connexion établie.
            $this->bConnected = true;

            # On retourne l'objet
            return $this->pdo;
        }
        catch (PDOException $e) {
            die('<h1>ERREUR LORS DE LA CONNEXION A LA BASE DE DONNEE. <br />REESAYEZ ULTERIEUREMENT</h1>');
        }
    }

    /*
     *   You can use this little method if you want to close the PDO connection
     */
    public function CloseConnection()
    {
        # On met l'objet PDO à null
        $this->pdo = null;
        $this->bConnected = false;
    }
}
?>