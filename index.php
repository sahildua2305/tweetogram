<?php
session_start();
if(isset($_GET['login']) && $_GET['login'] == "0"){
	echo '<p class="text-center alert-login">You need to login via Twitter!!!</p>';
}
include 'core/header.php';
?>

	<div class="jumbotron">
		<h1>Tweetogram</h1>
		<p class="lead">A simple application that demonstrates how to use Twitter PHP API.</p>
		
	<?php
	if(isset($_SESSION['twg_tw_name']) && isset($_SESSION['twg_tw_screen_name'])) {
		echo '<a class="btn btn-large btn-success" href="">View my profile</a>';
	}
	else{
		echo '<a class="btn btn-large btn-success" href="login.php">Login using Twitter</a>';
	}
	?>
	</div>
	<?php
	include 'core/footer.php';