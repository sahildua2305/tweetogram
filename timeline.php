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
	
	//$response = $connection->get('statuses/user_timeline', array());
	$response = $_SESSION['response-tweets'];
	//print_r($response[0]);
	
	foreach($response as $a){
		echo "<div class='timeline-tweets'>";
		echo "<img src='".$_SESSION['tw_profile_image_url']."' class='img-thumbnail timeline' width='50'>";
		echo "<a href='http://twitter.com/".$a->user->screen_name."' target='_blank'>".($a->user->name)."</a> <a href='http://twitter.com/".$a->user->screen_name."' target='_blank'>@".$a->user->screen_name."</a> ";
		echo ($a->text)."<br>";
		echo "At: ".($a->created_at);
		echo "</div>";
	}
}
?>





<?php
include 'core/footer.php';
?>