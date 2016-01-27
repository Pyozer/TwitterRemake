<?php
namespace App\Vendor;

/**
 * Class Form
 * Permet de générer des formulaires rapidement et simplement
 */
class Form {

	/**
	 * @var array Données utilisés par le formulaire
	 */
	protected $data;

	/**
	 * @var string Tag utilisé pour entourer les champs
	 */
	public $tag = "<p>";
	public $endtag = "</p>";

	/**
	 * Form constructor.
	 * @param array $data
	 */
	public function __construct($data = array()) {
		$this->data = $data;
	}

	/**
	 * @param $html string Code HTML à entouré
	 * @return string
	 */
	protected function surround($html) {
		return $this->tag . $html . $this->endtag;
	}

	/**
	 * @param $index string Index de la valeur à récuperer
	 * @return string
	 */
	protected function getValue($index) {
		return isset($this->data[$index]) ? $this->data[$index] : null;
	}

	/**
	 * @param $name string Renvoi le champs de texte
	 * @param $type string Précise aussi le type (text, password..)
	 * @return string
	 */
	public function input($name, $type = "text") {
		return $this->surround(
			'<input type="'.$type.'" name="'.$name.'" placeholder="'.$this->getValue($name).'">'
		);
	}

	/**
	 * @param $name string Précise le nom du submit
	 * @return string Renvoi le boutton submit
	 */
	public function submit($name = null) {
		return $this->surround(
			'<input type="submit" name="'.$name.'" value="'.$this->getValue($name).'">'
		);
	}
}