<?php
session_start();
include_once('dbconn.php');
$id=$_SESSION['uid'];
$email=$_POST['email'];
$sql="SELECT * from user where email='$email' AND userid!=$id;";
$result=mysqli_query($conn,$sql);
$resultcheck=mysqli_num_rows($result);
if ($resultcheck>0) {
	echo"This mail is already being used";
}else{
	$sql="UPDATE user set email='$email' where userid='$id';";
	$result=mysqli_query($conn,$sql);
	header("Location: ../profile.php");
	exit();
}
