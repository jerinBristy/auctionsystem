<?php
session_start();
include_once('dbconn.php');
$id=$_SESSION['uid'];
$phone=$_POST['phone'];
$sql="UPDATE user SET phone='$phone' WHERE userid=$id;";
mysqli_query($conn,$sql);
header("Location: ../profile.php");
exit();