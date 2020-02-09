<?php
session_start();
include_once('dbconn.php');
$id=$_SESSION['uid'];
$oldpass=$_POST['oldpass'];
$newpass=$_POST['newpass'];
$sql="SELECT pass from user WHERE userid=$id;";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$passcheck=password_verify($oldpass,$row['pass']);
if ($passcheck==false) {
	echo"Your old password didn't match. please try again";
	exit();
}else{
	$hpass=password_hash("$newpass",PASSWORD_DEFAULT);
	$sql="UPDATE user set pass='$hpass' where userid=$id";
	mysqli_query($conn,$sql);
	echo "success";
}