<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Tweetogram | Twitter API Demonstration & Examples</title>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<meta property="og:url" content="<?php echo $_SERVER['SCRIPT_URI']?>"/>
		<meta property="og:site_name" content="Sahil Dua"/>
		<meta property="og:title" content="Tweetogram | Twitter API Demonstration"/>
		<meta property="og:image" content="http://sahildua.collegespace.in/assets/img/ogTwitter.jpg"/>
		<meta property="og:type" content="website"/>
		<meta property="og:description" content="Tweetogram - A Twitter API demonstration application with all the possible actions permitted with the use of Twitter API!"/>
		<meta name="description" content="Tweetogram - A Twitter API demonstration application with all the possible actions permitted with the use of Twitter API!">
		<meta name="keywords" content="tweetogram, twitter, API, demo, demonstration, examples, possible, actions, tweets, messages, POST, GET, DELETE">
		
		<link rel="stylesheet" href="assets/css/bootstrap-responsive.min.css"/>
		<link rel="stylesheet" href="assets/css/bootstrap.min.css"  type="text/css"/>
		<link rel="stylesheet" href="assets/css/theme.css">
	</head>
	<body>
		<div class="container contain">
			<div class="navbar navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container">
						<div></div>
						<a class="brand" data-section="body" href="http://sahildua.collegespace.in/tweetogram/index.php">Tweetogram</a>
						<ul class="nav ">
							<li><a href="#">Hashtag Search</a></li>
							<li><a href="#">Statistics</a></li>
							<li><a href="#">Information</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="container">
			<div class="row-fluid">
				<div class="span12">
					<div class="jumbotron masthead">
						<div class="container">
							<h1>Tweetogram</h1>
							<p>A simple application which demonstrates how to use Twitter PHP API.</p>
							<p><a href="#me" class="btn btn-primary btn-large btn-login">Login with Twitter</a></p>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	<?php
	if(isset($_SESSION['twg_tw_name']) && isset($_SESSION['twg_tw_screen_name'])) {
		/*echo "Name :".$_SESSION['twg_tw_name']."<br>";
		echo "Screen Name :".$_SESSION['twg_tw_screen_name']."<br>";
		echo "Image :<img src='".$_SESSION['twg_tw_image']."'/><br>";
		echo "User ID :".$_SESSION['twg_tw_user_id']."<br>";
		echo "User Location :".$_SESSION['twg_tw_location']."<br>";
		echo "User Description:".$_SESSION['twg_tw_description']."<br>";
		echo "<br/><a href='logout.php'>Logout</a><br>";*/
	}
	else {
	?>

		<div align="center">
			<h2>Login with Twitter Demo</h2>
			Click on the image to start the Demo. <br/>
			<a href="login.php"><img src="assets/img/LoginTwitter.png"/></a>
		</div>
	<?php
	}
	?>
		<script src="js/jquery-1.10.2.js"></script>
		<script src="js/bootstrap..min.js"></script>
	</body>
</html>