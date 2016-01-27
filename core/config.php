<?php
namespace Core;

/**
 * Permet d'obtenir la valeur d'une configurtation demandé
 * Class Config
 * @package Core
 */
class Config {

    /**
     * @var array Tous les éléments du fichier de configuration qui sont chargés
     */
    public static $items = array();

    /**
     * @param $filepath Charge le fichier de configuration spécifié et définit $items
     */
    public static function load($filepath) {
    	static::$items = include(ROOT . '/app/config/' . $filepath . '.config.php' );
    }

    /**
     * Recherche dans $items et retourne la valeur
     * @param $arg
     * @param $default null
     * @return Valeur configuration
     */
    public static function get($arg, $default = null) {
        $input = explode('.', $arg);
        $filepath = $input[0];
        $key = $input[1];
        if(isset($input[2])) {
        	$subkey = $input[2];
        }
        /* On charge la config */
        static::load($filepath);

        /* Si le premier index n'est pas vide et existe */
        if(!empty($key) && isset(static::$items[$key])) {
            /* Si le second index n'est pas vide et existe */
        	if(!empty($subkey) && isset(static::$items[$key][$subkey])) {
        		return static::$items[$key][$subkey];
        	}
            return static::$items[$key];
        } else {
        	return $default;
        }
    }
}