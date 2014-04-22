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
				<a class="btn btn-success" href="timeline.php">Me</a>
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
	}
	else if((isset($_GET['deleted']) && $_GET['deleted'] == '1') || (isset($_GET['refresh']) && $_GET['refresh'] == '1') || !isset($_SESSION['response-tweets'])){
		$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $_SESSION['access_token']['oauth_token'], $_SESSION['access_token']['oauth_token_secret']);
		$response = $connection->get('statuses/user_timeline', array());
		$_SESSION['response-tweets'] = $response;
		print('<script>window.location="timeline.php";</script>');
	}
	else
		$response = $_SESSION['response-tweets'];
	//print_r($response);
	
?>
	<h3 style="float:left;"><?php echo $response[0]->user->name . " <i>(@" . $response[0]->user->screen_name . ")</i>"; ?></h3>
	<a class="btn btn-primary" href="timeline.php?refresh=1" style="float:right;">Refresh</a>
	<p style="clear: both;"></p>
	<p style="clear: both;"></p>

<?php
	$url = "http://sahildua.collegespace.in".$_SERVER['REQUEST_URI'];
	
	foreach($response as $a){
		echo "<div class='timeline-tweets'>";
		echo "<img src='".$a->user->profile_image_url."' class='img-thumbnail timeline' width='50'>";
		if(!isset($_GET['user']) || (isset($_GET['user']) && $_GET['user'] == $_SESSION['twg_tw_screen_name']))
			echo "<a class='timeline-close' href='delete.php?id_str=".$a->id_str."' onclick='return confirm(\"Are you sure you want to delete this tweet?\")'><img src='assets/img/icon_close_small.jpg'></a>";
		echo "<p><a href='http://twitter.com/".$a->user->screen_name."' target='_blank'>".($a->user->name)." <span class='muted'>@".$a->user->screen_name."</span></a></p>";
		echo ($a->text)."<br>";
		echo "<span class='muted small'>".date("g:i: A D, F jS Y",strtotime($a->created_at))."</span>";
		if(isset($_GET['user']) && $_GET['user'] != $_SESSION['twg_tw_screen_name'])
			echo "<p class='tweet-controls'><a href='favourite.php?link=".$url."&id_str=".$a->id_str."'>Favourite</a></p>";
		echo "</div>";
	}
}
?>





<?php
include 'core/footer.php';
?>