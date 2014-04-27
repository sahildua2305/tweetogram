<?php
session_start();
require_once('library/twitteroauth.php');
include('config.php');


if(!isset($_SESSION['twg_tw_name']) || !isset($_SESSION['twg_tw_screen_name'])) {
	header('Location: index.php?login=0');
}
include 'core/header.php';
?>

	<form class="form-inline" method="POST" action="">
		<div class="control-group">
			<label class="control-label"></label>
			<div class="controls">
				<div class="inout-append input-prepend">
					<span class="add-on">@</span>
					<input type="text" class="itemName" id="appendedPrependedInput" name="searchedUser" required/>
					<input class="btn btn-primary" type="submit" name="search" value="Search">
				</div>
				<a class="btn btn-success" href="timeline.php">Tweets</a>
				<a class="btn btn-success" href="timeline.php?me=1">Me</a>
				<a class="btn btn-success" href="timeline.php?mentioned=1">Mentions</a>
			</div>
		</div>
		<?php
			if(isset($_POST['search']) && $_POST['searchedUser'] != ''){
				print('<script>window.location="timeline.php?user='.$_POST['searchedUser'].'";</script>');
			}
		?>
	</form>
	
<?php
$response = '';
$show_mentioned_timeline = 0;
$show_my_timeline = 0;
if($_SESSION['access_token']){
	if((isset($_GET['user']) && $_GET['user'] != '') || ((isset($_GET['refresh']) && $_GET['refresh'] == '1') && (isset($_GET['user']) && $_GET['user'] != ''))){
		$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $_SESSION['access_token']['oauth_token'], $_SESSION['access_token']['oauth_token_secret']);
		$response = $connection->get('statuses/user_timeline', array('screen_name' => $_GET['user']));
		if($response->error != '' || $response->errors[0]->code == 34){
			echo '<br><br><h2 class="text-center">Username '.$GET['user'].' doesn\'t exist!</h3>';
			die();
		}
		if(count($response) == 0){
			echo '<br><br><h2 class="text-center">Not enough information available!</h3>';
			die();
		}
		if(strpos($_GET['user'], " ") !== false){
			echo '<br><br><h2 class="text-center">Incorrect username! Try again!</h3>';
			die();
		}
	}
	else if((isset($_GET['deleted']) && $_GET['deleted'] == '1') || !isset($_SESSION['response-tweets'])){
		$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $_SESSION['access_token']['oauth_token'], $_SESSION['access_token']['oauth_token_secret']);
		$response = $connection->get('statuses/user_timeline', array());
		$_SESSION['response-tweets'] = $response;
		print('<script>window.location="timeline.php?me=1";</script>');
	}
	else if(isset($_GET['mentioned']) && $_GET['mentioned'] == '1' && isset($_SESSION['response-mentions'])){
		$response = $_SESSION['response-mentions'];
		$show_mentioned_timeline = 1;
	}
	else if((isset($_GET['mentioned']) && $_GET['mentioned'] == '1') && !isset($_SESSION['response-mentions'])){
		$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $_SESSION['access_token']['oauth_token'], $_SESSION['access_token']['oauth_token_secret']);
		$response = $connection->get('statuses/mentions_timeline', array());
		$_SESSION['response-mentions'] = $response;
		$show_mentioned_timeline = 1;
	}
	else if(isset($_GET['me']) && $_GET['me'] == '1' && !isset($_SESSION['response-tweets'])){
		$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $_SESSION['access_token']['oauth_token'], $_SESSION['access_token']['oauth_token_secret']);
		$response = $connection->get('statuses/user_timeline', array());
		$_SESSION['response-tweets'] = $response;
		$show_my_timeline = 1;
	}
	else if(isset($_GET['me']) && $_GET['me'] == '1' && isset($_SESSION['response-tweets'])){
		$response = $_SESSION['response-tweets'];
		$show_my_timeline = 1;
	}
	else if(isset($_GET['refresh']) && $_GET['refresh'] == '1'){
		$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $_SESSION['access_token']['oauth_token'], $_SESSION['access_token']['oauth_token_secret']);
		$response = $connection->get('statuses/home_timeline', array());
		$_SESSION['response-home'] = $response;
	}
	else
		$response = $_SESSION['response-home'];
	//print_r($response);
	//die();
	//print_r($_SESSION['response-tweets']);
?>
	<h3 style="float:left;"><?php if($show_mentioned_timeline == '1') echo $_SESSION['twg_tw_name'] . " <i>(@" . $_SESSION['twg_tw_screen_name'] . ")</i>"; else if(isset($_GET['me']) && $_GET['me'] == '1') echo $response[0]->user->name . " <i>(@" . $response[0]->user->screen_name . ")</i>"; else echo "Tweets" ?></h3>
	<?php
	if($show_mentioned_timeline == 0 && $show_my_timeline == 0){
	?>
	<a class="btn btn-primary" href="timeline.php?refresh=1" style="float:right;">Refresh</a>
	<?php
	}
	?>
	<p style="clear: both;"></p>
	<p style="clear: both;"></p>

<?php
	$url = "http://sahildua.collegespace.in".$_SERVER['REQUEST_URI'];
	
	foreach($response as $a){
		echo "<div class='timeline-tweets'>";
		echo "<img src='".$a->user->profile_image_url."' class='img-thumbnail timeline' width='50'>";
		if($a->user->screen_name == $_SESSION['twg_tw_screen_name'])
			echo "<a class='timeline-close' href='delete.php?id_str=".$a->id_str."' onclick='return confirm(\"Are you sure you want to delete this tweet?\")'><img src='assets/img/icon_close_small.jpg'></a>";
		echo "<p><a href='http://twitter.com/intent/user?screen_name=".$a->user->screen_name."' target='_blank'>".($a->user->name)." <span class='muted'>@".$a->user->screen_name."</span></a></p>";
		echo ($a->text)."<br>";
		echo "<span class='muted small'>".date("g:i: A D, F jS Y",strtotime($a->created_at))."</span>";
		if($a->user->screen_name != $_SESSION['twg_tw_screen_name'])
			echo "<p class='tweet-controls'><a href='https://twitter.com/intent/tweet?in_reply_to=".$a->id_str."'> Reply </a><a href='https://twitter.com/intent/favorite?tweet_id=".$a->id_str."'> Favorite </a><a href='https://twitter.com/intent/retweet?tweet_id=".$a->id_str."'> Retweet </a></p>";
		echo "</div>";
	}
}
?>





<?php
include 'core/footer.php';
?>