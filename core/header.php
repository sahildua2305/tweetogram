<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Tweetogram | Twitter API Demonstration & Examples</title>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<meta property="og:url" content="http://sahildua.collegespace.in/tweetogram/"/>
		<meta property="og:site_name" content="Sahil Dua"/>
		<meta property="og:title" content="Tweetogram | Twitter API Demonstration"/>
		<meta property="og:image" content="http://sahildua.collegespace.in/tweetogram/assets/img/ogTwitter.jpg"/>
		<meta property="og:type" content="website"/>
		<meta property="og:description" content="Tweetogram - A Twitter API demonstration application with all the possible actions permitted with the use of Twitter API!"/>
		<meta name="description" content="Tweetogram - A Twitter API demonstration application with all the possible actions permitted with the use of Twitter API!">
		<meta name="keywords" content="tweetogram, twitter, API, demo, demonstration, examples, possible, actions, tweets, messages, POST, GET, DELETE">
		
		<link rel="stylesheet" href="assets/css/bootstrap-responsive.min.css"/>
		<link rel="stylesheet" href="assets/css/bootstrap.min.css"  type="text/css"/>
		<link rel="stylesheet" href="assets/css/theme.css">
	</head>
	<body>
		<div class="container-narrow container">

			<div class="masthead">
				<ul class="nav nav-pills pull-right">
					<li><a href="profile.php">My Profile</a></li>
					<li><a href="timeline.php">Timeline</a></li>
					<li><a href="post.php">New Tweet</a></li>
					<li><a href="followers.php">Followers</a></li>
					<li class="active"><?php if(isset($_SESSION['twg_tw_name']) && isset($_SESSION['twg_tw_screen_name']))  echo '<a href="logout.php">Logout</a>';  else echo '<a href="login.php">Login</a>'; ?></li>
				</ul>
				<h3 class="muted">Tweetogram</h3>
			</div>

			<hr>
