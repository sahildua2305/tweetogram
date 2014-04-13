<?php
session_start();
require_once('library/twitteroauth.php');
include('config.php');

if(!isset($_SESSION['twg_tw_name']) || !isset($_SESSION['twg_tw_screen_name'])) {
	header('Location: index.php?login=0');
}
include 'core/header.php';

//Twitter GET info
$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $ACCESS_TOKEN, $ACCESS_SECRET);
$params =array();
$params['include_entities']='false';
$content = $connection->get('account/verify_credentials',$params);
if($content && isset($content->screen_name) && isset($content->name)){
	$tw_name = $content->name; //
	$tw_screen_name = $content->screen_name; //
	$tw_created_at = $content->created_at; //
	$tw_description = $content->description; //
	$tw_favourites_count = $content->favourites_count; //
	$tw_followers_count = $content->followers_count; //
	$tw_friends_coun = $content->friends_count; //
	$tw_id_str = $content->id_str; //
	$tw_listed_count = $content->listed_count;
	$tw_location = $content->location; //
	$tw_profile_image_url = $content->profile_image_url; //
	$tw_latest_tweet = $content->status->text; //
	$tw_tweet_count = $content->statuses_count; //
	$tw_verified = $content->verified;
	$tw_url = $content->url;
}

?>
	<img class="img-thumbnail" src="<?php echo $tw_profile_image_url; ?>" width="100" style="float:left;">
	<h3><?php echo $tw_name . " <i>(@" . $tw_screen_name . ")</i>"; ?></h3>
	<p style="clear: both;"></p>
	
	<table class="table table-striped">
		<tr>
			<td>User ID</td>
			<td><?php echo $tw_id_str; ?></td>
		</tr>
		<tr>
			<td>Account created at</td>
			<td><?php echo $tw_created_at; ?></td>
		</tr>
		<tr>
			<td>Location</td>
			<td><?php echo $tw_location; ?></td>
		</tr>
		<tr>
			<td>Description</td>
			<td><?php echo $tw_description; ?></td>
		</tr>
		<tr>
			<td>Total number of tweets</td>
			<td><?php echo $tw_tweet_count; ?></td>
		</tr>
		<tr>
			<td>Total number of followers</td>
			<td><?php echo $tw_followers_count; ?></td>
		</tr>
		<tr>
			<td>Total number of following</td>
			<td><?php echo $tw_friends_coun; ?></td>
		</tr>
		<tr>
			<td>Favourites tweets</td>
			<td><?php echo $tw_favourites_count; ?></td>
		</tr>
		<tr>
			<td>Latest Tweet</td>
			<td><?php echo $tw_latest_tweet; ?></td>
		</tr>
	</table>
<?php
include 'core/footer.php';
?>