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
require ROOT . '/vendor/autoload.php';

ini_set("display_errors", Config::get('app.debug'));
ini_set('default_charset', Config::get('app.default_charset'));
header("Content-Type: text/html; charset=" . Config::get('app.default_charset') . "");
date_default_timezone_set(Config::get('app.timezone'));
setlocale (LC_TIME, 'fr_FR.utf8','fra');

/* On charge l'Autolader */
AutoloaderApp::register();
