<?php
session_start();
require_once('library/twitteroauth.php');
include('config.php');

$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET);
$request_token = $connection->getRequestToken($OAUTH_CALLBACK); //get Request Token

if(	$request_token)
{
   $token = $request_token['oauth_token'];
   $_SESSION['request_token'] = $token ;
   $_SESSION['request_token_secret'] = $request_token['oauth_token_secret'];
   
   switch ($connection->http_code) 
   {
		case 200:
			 $url = $connection->getAuthorizeURL($token);
			 //redirect to Twitter .
		header('Location: ' . $url); 
			break;
		default:
			echo "Connection with twitter Failed";
		break;
   }

}
else //error receiving request token
{
   echo "Error Receiving Request Token";
}

echo '<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script>
	$(document).ready( function (){
		self.close();
		console.log("window should be closed");
	});
</script>';
?>