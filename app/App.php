<?php
namespace App;

use Core\Config;

/**
 * Class App - Classe polyvalente de l'application
 * @package App
 */
class App {

    private static $title_page = "Accueil";

    /**
     * @param $title Défini le title de la page
     */
    public static function setTitle($title) {
        self::$title_page = $title . ' | ' . Config::get('app.title');
    }

    /**
     * @return string Renvoi le titre de la page
     */
    public static function getTitle() {
        return self::$title_page;
    }
}