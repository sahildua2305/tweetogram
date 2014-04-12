<?php
session_start();

if(isset($_SESSION['twg_tw_name']) && isset($_SESSION['twg_tw_screen_name'])) //check whether user already logged in with twitter
{
	echo "Name :".$_SESSION['twg_tw_name']."<br>";
	echo "Screen Name :".$_SESSION['twg_tw_screen_name']."<br>";
	echo "Image :<img src='".$_SESSION['twg_tw_image']."'/><br>";
	echo "User ID :".$_SESSION['twg_tw_user_id']."<br>";
	echo "User Location :".$_SESSION['twg_tw_location']."<br>";
	echo "User Description:".$_SESSION['twg_tw_description']."<br>";
	echo "<br/><a href='logout.php'>Logout</a><br>";
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
