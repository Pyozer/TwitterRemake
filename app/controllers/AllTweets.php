<?php
/**
 * AllTweet Controller
 * Affiche tous les tweets provenant de personne que
 * notre utilisateur suit sont affichés, ainsi que les siens.
 */
use Core\Config;
use App\Vendor\Tweets;
use App\Vendor\User;

$userid = $_SESSION['userid'];
$tweets = Tweets::getInstance($DB_con, $userid);
/* On récupère tous les tweets */
$alltweets = $tweets->getAllTweets();
$user = User::getInstance($DB_con);
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

	$img_profil = $user->getUserImg($tweet->user_id);

	$img_tweet = $tweet->media_tweet;

	$nbr_rt = $tweet->nbr_rt;
	$nbr_fav = $tweets->getNbrFav($tweet->id);
	$nbr_reply = $tweets->getNbrReply($tweet->id);

	require Config::get('view.paths') . '/templates/tweet.template.php';
}