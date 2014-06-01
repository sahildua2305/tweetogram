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
	
	$response = $connection->get('followers/list', array(1465557218324006364));
	print_r($response);
	
	echo '<ul class="thumbnails">';
	foreach($response->users as $user){
		echo '<li class="span4">';
		echo '<a href="http://twitter.com/intent/user?screen_name='.$user->screen_name.'" class="thumbnail" target="_blank">';
		echo '<img src="'.$user->profile_image_url.'" class="img-rounded" width="100">';
		echo '<h4 class="text-center">'.$user->name.'</h4>';
		echo '<p class="text-center">@'.$user->screen_name.'</p>';
		echo '</a>';
		echo '</li>';
	}
	echo '</ul>';
}

?>



<?php
include 'core/footer.php';
?>