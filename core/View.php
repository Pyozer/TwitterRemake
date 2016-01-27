<?php
namespace Core;

/**
 * Class View - Permet de gérer les view
 * @package Core
 */
class View {

    private $vars = array();

    public function __get($name) {
        return $this->vars[$name];
    }

    public function __set($name, $value) {
        if($name == 'view_template_file') {
            throw new Exception("Cannot bind variable named 'view_template_file'");
        }
        $this->vars[$name] = $value;
    }

    public function render($view_name, $data = []) {
        if(array_key_exists('view_template_file', $this->vars)) {
            throw new Exception("Cannot bind variable called 'view_template_file'");
        }
        extract($this->vars);
        extract($data);
        ob_start();
        include Config::get('view.paths') . $view_name . '.php';
        return ob_get_clean();
    }
}