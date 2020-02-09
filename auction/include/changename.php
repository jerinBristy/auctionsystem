<?php
session_start();
include_once('dbconn.php');
$id=$_SESSION['uid'];
$name=$_POST['name'];
$sql="UPDATE user SET name='$name' WHERE userid=$id;";
mysqli_query($conn,$sql);
header("Location: ../profile.php");
exit();