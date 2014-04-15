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
		$response = $connection->get('statuses/user_timeline', array());
		$_SESSION['response-tweets'] = $response;

		if($content && isset($content->screen_name) && isset($content->name))
		{
			$_SESSION["twg_tw_name"] = $content->name; //echo $_SESSION['twg_tw_name'];
			$_SESSION["twg_tw_screen_name"] = $content->screen_name;
			$_SESSION['tw_created_at'] = $content->created_at; //
			$_SESSION['tw_description'] = $content->description; //
			$_SESSION['tw_favourites_count'] = $content->favourites_count; //
			$_SESSION['tw_followers_count'] = $content->followers_count; //
			$_SESSION['tw_friends_count'] = $content->friends_count; //
			$_SESSION['tw_id_str'] = $content->id_str; //
			$_SESSION['tw_listed_count'] = $content->listed_count;
			$_SESSION['tw_location'] = $content->location; //
			$_SESSION['tw_profile_image_url'] = $content->profile_image_url; //
			$_SESSION['tw_latest_tweet'] = $content->status->text; //
			$_SESSION['tw_tweet_count'] = $content->statuses_count; //
			$_SESSION['tw_verified'] = $content->verified;
			$_SESSION['tw_url'] = $content->url;
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