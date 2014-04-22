<?php
session_start();
require_once('library/twitteroauth.php');
include('config.php');

if(!isset($_SESSION['twg_tw_name']) || !isset($_SESSION['twg_tw_screen_name'])) {
	header('Location: index.php?login=0');
}
include 'core/header.php';
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

	<h3 class="text-center">Post tweets to your Twitter Account</h3>
	<br><br>
	
	<form class="form-horizontal" method="POST" action="">
		<div class="control-group">
			<label class="control-label">Tweet Text</label>
			<div class="controls">
				<textarea rows="4" cols="70" class="itemName" name="tweetText"><?php if(isset($_POST['tweetText'])) echo $_POST['tweetText']; ?></textarea>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<input class="btn btn-primary btn-large post" type="submit" name="tweet" value="Tweet" style="float:left;">
				<div class="charCount"></div>
			</div>
		</div>
		<script>
			$('textarea').on('input', count);
			function count(){
				var val = $.trim($('textarea').val());
				var chars = 0;
				chars = val.length;
				if(chars>120)
					$('.charCount').html("<span style='color:red;'>" + (140-chars) + "</span>");
				else if(chars>0 && chars<=120 || chars==0)
					$('.charCount').html("<span style='color:green;'>" + (140-chars) + "</span>");
				else if(chars>140)
					$('.charCount').html("<span style='background:red;color:white;'>" + (140-chars) + "</span>");
			}
			count();
		</script>
	</form>
<?php
if(isset($_POST['tweet'])){
	$tweetText = strip_tags($_POST['tweetText']);
	if(strlen($tweetText) > 140){
		echo '<p class="text-center alert-error">Tweet Max limit(140 characters) crossed!!!</p>';
	}
	else{
		if($_SESSION['access_token']){
			$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $_SESSION['access_token']['oauth_token'], $_SESSION['access_token']['oauth_token_secret']);
			
			$response = $connection->post('statuses/update', array('status' => $tweetText));
			if($response->errors[0]->message!=""){
				$msg=$response->errors[0]->message;
				echo '<p class="text-center alert-error">'.$msg.'</p>';
			}
			else if($response->text!=""){
				echo '<p class="text-center alert-success">Tweet Sent!</p>';
			}
		}
	}
}
?>
<?php
include 'core/footer.php';
?>