<?php
session_start();
include_once('dbconn.php');
if (isset($_POST['remove'])) {
	$itemid=$_GET['itemid'];
	echo "$itemid";
	$sql="DELETE from item where itemid='$itemid';";
	mysqli_query($conn,$sql);
	header("Location: ../profile.php?delete=success");
	exit();
}else {
	header("Location: ../profile.php?delete=unsuccess");
	exit();
}