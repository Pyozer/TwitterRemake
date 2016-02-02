<?php
/**
 * Fichier Init, permet de lancer les autoloader
 * Défini aussi les paramètres par défaut du site
 */
use Core\Config;
use App\AutoloaderApp;

session_start();
define('ROOT', dirname(__DIR__));

require ROOT . '/core/config.php';
require ROOT . '/app/AutoloaderApp.php';
require ROOT . '/app/vendor/functions.php';
require ROOT . '/vendor/autoload.php';

ini_set("display_errors", Config::get('app.debug'));
ini_set('default_charset', Config::get('app.default_charset'));
header("Content-Type: text/html; charset=" . Config::get('app.default_charset') . "");
date_default_timezone_set(Config::get('app.timezone'));
setlocale (LC_TIME, 'fr_FR.utf8','fra');

/*|--------------------------------------------------
  | Connexion à la base de donnée
  |--------------------------------------------------
*/
try
{
    $DB_host = Config::get('database.mysql.host');
    $DB_name = Config::get('database.mysql.database');
    $DB_user = Config::get('database.mysql.username');
    $DB_pass = Config::get('database.mysql.password');

    $DB_con = new PDO('mysql:host='.$DB_host.';dbname='.$DB_name.';', ''.$DB_user.'', ''.$DB_pass.'');
    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $DB_con->exec("SET CHARACTER SET utf8");
}
catch(PDOException $e)
{
    die('<h1>ERREUR LORS DE LA CONNEXION A LA BASE DE DONNEE. <br />REESAYEZ ULTERIEUREMENT</h1>');
}

/* On charge l'Autolader */
AutoloaderApp::register();
