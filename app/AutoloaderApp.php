<?php
namespace App;

/**
 * Class Autoloader - Charge dynamiquement les class du dossier App
 */
class AutoloaderApp {

    /**
     * Enregistre notre autoloader
     */
    static function register() {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclue le fichier correspondant à notre classe
     * @param $class_name string Le nom de la classe à charger
     */
    static function autoload($class_name) {
        if(strpos($class_name, __NAMESPACE__ . '\\') === 0) {
            $class_name = str_replace(__NAMESPACE__ . '\\', '', $class_name);
            $class_name = str_replace('\\', '/', $class_name);
            require ROOT . '/app/' . $class_name . '.php';
        }
    }
}