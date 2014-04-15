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
	
	if(isset($_GET['deleted']) && $_GET['deleted'] == '1'){
		$response = $connection->get('statuses/user_timeline', array());
		$_SESSION['response-tweets'] = $response;
	}
	else
		$response = $_SESSION['response-tweets'];
	//$response = $_SESSION['response-tweets'];
	//print_r($response[0]);
	
	foreach($response as $a){
		echo "<div class='timeline-tweets'>";
		echo "<img src='".$_SESSION['tw_profile_image_url']."' class='img-thumbnail timeline' width='50'>";
		echo "<a class='timeline-close' href='delete.php?id_str=".$a->id_str."' onclick='return confirm(\"Are you sure you want to delete this tweet?\")'><img src='assets/img/icon_close_small.jpg'></a>";
		echo "<p><a href='http://twitter.com/".$a->user->screen_name."' target='_blank'>".($a->user->name)." <span class='muted'>@".$a->user->screen_name."</span></a></p>";
		echo ($a->text)."<br>";
		echo "<span class='muted small'>".date("g:i: A D, F jS Y",strtotime($a->created_at))."</span>";
		echo "</div>";
	}
}
?>





<?php
include 'core/footer.php';
?>