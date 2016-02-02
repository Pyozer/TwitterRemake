<?php
return array(

	/*
	|--------------------------------------------------------------------------
	| Application Debug Mode
	|--------------------------------------------------------------------------
	| Permet de déterminer si le site est en debug mode ou non
	| Si le debug est sur true, les erreurs seront affichés
	|
	*/

	'debug' => true,

	/*
	|--------------------------------------------------------------------------
	| Application URL And Title
	|--------------------------------------------------------------------------
	| Détermine l'URL du site web.
	| Détermine aussi le titre du site par defaut.
	|
	*/

	'url' => 'localhost',
	'title' => 'Twitter',

	/*
	|--------------------------------------------------------------------------
	| Application Locale Configuration
	|--------------------------------------------------------------------------
	| L'application locale détermine la langue par défaut qui sera utilisé
	| par le fournisseur de service de traduction.
	|
	*/

	'locale' => 'fr',

	/*
	|--------------------------------------------------------------------------
	| Application TimeZone Configuration
	|--------------------------------------------------------------------------
	| Détermine la TimeZone par défaut, permet d'avoir une heure local correct
	| TimeZone par defaut: 'Europe/Paris'
	|
	*/

	'timezone' => 'Europe/Paris',

	/*
	|--------------------------------------------------------------------------
	| Application Default Charset
	|--------------------------------------------------------------------------
	| Détermine le type d'encodage par défaut
	| Valeur initial: UTF-8
	|
	*/
	
	'default_charset' => 'utf-8',

	/*
	|--------------------------------------------------------------------------
	| Application Default Include Path
	|--------------------------------------------------------------------------
	| Détermine le chemin d'accès des inclusions (header, footer..)
	| Détermine le chemin d'accès des controllers
	*/

	'include_paths' => ROOT . '/includes/',
	'controller_paths' => ROOT . '/app/controllers/',

);
