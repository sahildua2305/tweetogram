<?php
session_start();
require_once('library/twitteroauth.php');
include('config.php');

if(!isset($_SESSION['twg_tw_name']) || !isset($_SESSION['twg_tw_screen_name'])) {
	header('Location: index.php?login=0');
}
include 'core/header.php';

$tw_name = $_SESSION["twg_tw_name"];
$tw_user_id = $_SESSION["twg_tw_user_id"];
$tw_screen_name = $_SESSION["twg_tw_screen_name"];
$tw_image = $_SESSION["twg_tw_image"];
$tw_description = $_SESSION["twg_tw_description"];
$tw_location = $_SESSION["twg_tw_location"];

?>
	<img class="img-thumbnail" src="<?php echo $tw_image; ?>" width="150" style="float:left;">
	<h3><?php echo $tw_name . " <i>(@" . $tw_screen_name . ")</i>"; ?></h3>
	<p style="clear: both;"></p>
	
	<table class="table table-striped">
		<tr>
			<td>User ID</td>
			<td><?php echo $tw_user_id; ?></td>
		</tr>
		<tr>
			<td>Location</td>
			<td><?php echo $tw_location; ?></td>
		</tr>
		<tr>
			<td>Description</td>
			<td><?php echo $tw_description; ?></td>
		</tr>
	</table>
<?php
include 'core/footer.php';
?>