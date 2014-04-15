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
	
	$response = $connection->get('followers/ids', array());
	print_r($response);
	echo $response->ids[0];
	
	$show = $connection->get('users/show', array(), $response->ids[0]);
	print_r($show);
	
}


?>