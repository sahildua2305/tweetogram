<?php
session_start();
require_once('library/twitteroauth.php');
include('config.php');

if(!isset($_SESSION['twg_tw_name']) || !isset($_SESSION['twg_tw_screen_name'])) {
	header('Location: index.php?login=0');
}
include 'core/header.php';

if($_SESSION['access_token']){
	if(isset($_GET['refresh']) && $_GET['refresh'] == '1'){
		$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $_SESSION['access_token']['oauth_token'], $_SESSION['access_token']['oauth_token_secret']);
		$params =array();
		$params['include_entities']='false';
		$content = $connection->get('account/verify_credentials',$params);
		//print_r($content);
		
		if($content && isset($content->screen_name) && isset($content->name)){
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
		}
		
		print('<script>window.location="profile.php";</script>');
	}
}
?>
	<img class="img-thumbnail" src="<?php echo $_SESSION['tw_profile_image_url']; ?>" width="50" style="float:left;">
	<h3 style="float:left;"><?php echo $_SESSION['twg_tw_name'] . " <i>(@" . $_SESSION['twg_tw_screen_name'] . ")</i>"; ?></h3>
	<a class="btn btn-primary" href="profile.php?refresh=1" style="float:right;">Refresh</a>
	
	<table class="table table-striped">
		<tr>
			<td>User ID</td>
			<td><?php echo $_SESSION['tw_id_str']; ?></td>
		</tr>
		<tr>
			<td>Account created at</td>
			<td><?php echo date("g:i: A D, F jS Y",strtotime($_SESSION['tw_created_at'])); ?></td>
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