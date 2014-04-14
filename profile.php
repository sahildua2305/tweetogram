<?php
session_start();
require_once('library/twitteroauth.php');
include('config.php');

if(!isset($_SESSION['twg_tw_name']) || !isset($_SESSION['twg_tw_screen_name'])) {
	header('Location: index.php?login=0');
}
include 'core/header.php';

$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $_SESSION['request_token'], $_SESSION['request_token_secret']);
$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

if($access_token){
	$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
	$params =array();
	$params['include_entities']='false';
	$content = $connection->get('account/verify_credentials',$params);

	if($content && isset($content->screen_name) && isset($content->name)){
		echo $content->name;
	}
}
var_dump($access_token);
?>
	<img class="img-thumbnail" src="<?php echo $_SESSION['tw_profile_image_url']; ?>" width="100" style="float:left;">
	<h3><?php echo $_SESSION['twg_tw_name'] . " <i>(@" . $_SESSION['twg_tw_screen_name'] . ")</i>"; ?></h3>
	<p style="clear: both;"></p>
	
	<table class="table table-striped">
		<tr>
			<td>User ID</td>
			<td><?php echo $_SESSION['tw_id_str']; ?></td>
		</tr>
		<tr>
			<td>Account created at</td>
			<td><?php echo $_SESSION['tw_created_at']; ?></td>
		</tr>
		<tr>
			<td>Location</td>
			<td><?php echo $_SESSION['tw_location']; ?></td>
		</tr>
		<tr>
			<td>Description</td>
			<td><?php echo $_SESSION['tw_description']; ?></td>
		</tr>
		<tr>
			<td>Total number of tweets</td>
			<td><?php echo $_SESSION['tw_tweet_count']; ?></td>
		</tr>
		<tr>
			<td>Total number of followers</td>
			<td><?php echo $_SESSION['tw_followers_count']; ?></td>
		</tr>
		<tr>
			<td>Total number of following</td>
			<td><?php echo $_SESSION['tw_friends_count']; ?></td>
		</tr>
		<tr>
			<td>Favourites tweets</td>
			<td><?php echo $_SESSION['tw_favourites_count']; ?></td>
		</tr>
		<tr>
			<td>Latest Tweet</td>
			<td><?php echo $_SESSION['tw_latest_tweet']; ?></td>
		</tr>
	</table>
<?php
include 'core/footer.php';
?>