<?php
session_start();
include_once('dbconn.php');
$id=$_SESSION['uid'];
$address=$_POST['address'];
$sql="UPDATE user SET address='$address' WHERE userid=$id;";
mysqli_query($conn,$sql);
header("Location: ../profile.php");
exit();