<?php
use Core\Config;

for ($i=0; $i < 10; $i++) { 
	$href = "/connexion.php";
	$user_fullname = "Jean-Charles Moussé";
	$user_username = "@Jc_Mousse";
	$date_publish = "2 heure";
	$img_profil = "http://interminale.fr.nf/images/profil/02192cc8dbd3607529cc54f61c9763ef128e0e26.jpg";
	$tweet_text = "<a href=\"/AnneRiviere3\" class=\"tweet-mention-user\"><b>@gadelmaleh</b></a> Encore une fois vous avez vendu du rêve, une bonne soirée pleine de rire grâce a vous 😂❤ #LesInvisibles #Love";
	require Config::get('view.paths') . '/templates/tweet.template.php';
}