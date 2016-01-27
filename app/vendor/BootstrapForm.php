<?php
namespace App\Vendor;

/**
 * Class Form pour Bootstrap
 * Permet de générer des formulaires rapidement et simplement
 */
class BootstrapForm extends Form {

    public $tag = "<div class=\"form-group\">";
    public $endtag = "</div>";

    /**
     * @param $html string Code HTML à entouré
     * @return string
     */
    protected function surround($html) {
        return $this->tag . $html . $this->endtag;
    }

    /**
     * @param $name string Renvoi le champs de texte
     * @param $type string Précise aussi le type (text, password..)
     * @return string
     */
    public function input($name, $type = "text") {
        return $this->surround(
            '<label>' . $name . '</label>
            <input type="' . $type . '" name="' . $name . '" value="' . $this->getValue($name) . '" class="form-control">'
        );
    }

    /**
     * @param $name string Précise le nom du submit
     * @return string Renvoi le boutton submit
     */
    public function submit($name = null) {
        return $this->surround(
            '<input type="submit" name="'.$name.'" class="btn btn-primary">'
        );
    }
}