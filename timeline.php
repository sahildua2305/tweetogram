<?php
session_start();
require_once('library/twitteroauth.php');
include('config.php');

if(!isset($_SESSION['twg_tw_name']) || !isset($_SESSION['twg_tw_screen_name'])) {
	header('Location: index.php?login=0');
}
include 'core/header.php';


if($_SESSION['access_token']){
	$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $_SESSION['access_token']['oauth_token'], $_SESSION['access_token']['oauth_token_secret']);
	
	$response = $connection->get('statuses/user_timeline', array());
	//print_r($response[0]);
	
	foreach($response as $a){
		echo "@".($a->user->screen_name)." | ";
		echo ($a->text)."<br>";
		echo "At: ".($a->created_at);
		echo "<br><br>";
	}
}
?>





<?php
include 'core/footer.php';
?>