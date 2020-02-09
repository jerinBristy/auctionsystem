<?php
session_start();
include_once('dbconn.php');
$id=$_SESSION['uid'];
$itemid=$_GET['itemid'];
$startingbid=$_GET['startingbid'];

$sql="SELECT highestbid from bidstats where itemid=$itemid;";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$resultcheck=mysqli_num_rows($result);
$amount=$_POST['money'];

if ($resultcheck>0 && $amount<=$row['highestbid']) {
	$highestbid=$row['highestbid'];
	echo "your bid has to be greater than $highestbid taka";
	//header("Location: ../item.php?id=$itemid&error");
	exit();
}elseif ($resultcheck==0 && $amount<$startingbid) {
	echo "your bid has to be greater than or equal to $startingbid taka";
	//header("Location: ../item.php?id=$itemid&baseerror");
	exit();
}else{
	$sql="INSERT into bidstats(itemid,highestbid,highestbidder) values ('$itemid','$amount','$id');";
	mysqli_query($conn,$sql);

	$sql="INSERT into bidson(itemid,ownbid,userid) values ('$itemid','$amount','$id');";
	mysqli_query($conn,$sql);	
	header("Location: ../item.php?id=$itemid&success");
	exit();	
}
