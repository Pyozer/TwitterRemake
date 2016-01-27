<?php
return array(

	/*
	|--------------------------------------------------------------------------
	| PDO Fetch Style
	|--------------------------------------------------------------------------
	| Par défaut, les résultats de la base de données seront retournées
	| comme des instances de l'objet PHP (stdClass)
	|
	*/

	'fetch' => PDO::FETCH_CLASS,

	/*
	|--------------------------------------------------------------------------
	| Database Connection
	|--------------------------------------------------------------------------
	| Configuration pour la connexion à la Base De Données
	| Défini l'Hôte, la database, l'user et le mot de passe
	| Ajoute aussi quelques configurations supplémentaires
	|
	*/
	'mysql' => array(
		'host'      => 'localhost',
		'database'  => 'sitetest',
		'username'  => 'root',
		'password'  => '',
		'charset'   => 'utf8',
	),
);
