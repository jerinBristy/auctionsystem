<?php
session_start();
include_once('dbconn.php');
$userid=$_GET['userid'];
$sql="DELETE from user where userid='$userid';";
mysqli_query($conn,$sql);
header("Location: ../user.php");
exit();