<?php
session_start();
require_once('library/twitteroauth.php');
include('config.php');


if(isset($_GET['oauth_token']))
{
	$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $_SESSION['request_token'], $_SESSION['request_token_secret']);
	$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
	$_SESSION['access_token'] = $access_token;
	
	if($access_token)
	{
		$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
		$params =array();
		$params['include_entities']='false';
		$content = $connection->get('account/verify_credentials',$params);

		if($content && isset($content->screen_name) && isset($content->name))
		{
			$_SESSION["twg_tw_name"] = $content->name;
			$_SESSION["twg_tw_user_id"] = $content->id;
			$_SESSION["twg_tw_screen_name"] = $content->screen_name;
			$_SESSION["twg_tw_image"] = $content->profile_image_url;
			$_SESSION["twg_tw_description"] = $content->description;
			$_SESSION["twg_tw_location"] = $content->location;
			//redirect to main page.
			header('Location: index.php'); 
		}
	}
	else
	{
		echo "<h4> Login Error Invalid access token</h4>";
	}
}
else //Error. redirect to Login Page.
{
	header('Location: http://sahildua.collegespace.in/tweetogram/login.php'); 
}

?>