<?php
/**
 * Récupère et affiche les tweets d'un utilisateur précis
 */
use Core\Config;
use App\Vendor\Tweets;

$userid = $info_profil->id;
$tweets = Tweets::getInstance($DB_con, $userid);
/* On récupère tous les tweets d'un utilisateur */
$alltweets = $tweets->getUserTweets();
/* On affiche ensuite les tweets */
foreach ($alltweets as $keyPrimary => $tweet) {
	$href = "/profil.php?user=" . $tweet->pseudo;
	$user_fullname = $tweet->prenom . " " . $tweet->nom;
	$user_username = "@" . $tweet->pseudo;

	$datetime = new DateTime($tweet->date);
	$date_timeago = $datetime->format(DateTime::ISO8601);

	$date_publish = AffDate(strtotime($tweet->date));
	$idtweet = $tweet->id;

	$tweet_text = $tweet->tweet;

	$img_profil = "https://pbs.twimg.com/profile_images/671484118035734532/KBNaQRTb_400x400.png";

	$img_tweet = $tweet->media_tweet;

	$nbr_rt = $tweet->nbr_rt;
	$nbr_fav = $tweets->getNbrFav($tweet->id);
	$nbr_reply = $tweets->getNbrReply($tweet->id);

	require Config::get('view.paths') . '/templates/tweet.template.php';
}