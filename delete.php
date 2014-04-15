<?php
session_start();
require_once('library/twitteroauth.php');
include('config.php');


if(!isset($_SESSION['twg_tw_name']) || !isset($_SESSION['twg_tw_screen_name'])) {
	header('Location: index.php?login=0');
}
//include 'core/header.php';

if(isset($_GET['id_str'])){
	//echo $_GET['id_str'];
	if($_SESSION['access_token']){
		$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $_SESSION['access_token']['oauth_token'], $_SESSION['access_token']['oauth_token_secret']);
		//delete the tweet
		$connection->post("statuses/destroy/".$_GET['id_str'], array());
		//redirect
		header('Location: timeline.php');
	}
}

