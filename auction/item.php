<?php
session_start();
include_once('include/dbconn.php');
include_once('header.php');
$id=$_SESSION['uid'];

$item=$_GET['id'];
$sql="SELECT u.name as owner,phone,i.name,itemid,ownerid,description,duration,startingbid,pic1 from item i,user u where i.itemid=$item AND u.userid=ownerid;";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$itemid=$row['itemid'];
$itemname=$row['name'];
$owner=$row['owner'];
$lastdate=$row['duration'];
$startingbid=$row['startingbid'];
$description=$row['description'];
$pic=$row['pic1'];
$phone=$row['phone'];
$ownerid=$row['ownerid'];

$sql="SELECT adminflag from user where userid=$id";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$admin=$row['adminflag'];

$sql="SELECT * from bidstats where itemid=$itemid;";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$resultcheck=mysqli_num_rows($result);
if ($resultcheck>0) {
		$highestbid=$row['highestbid'];
		$highestbidderid=$row['highestbidder'];

		$sql="SELECT name from user where userid=$highestbidderid;";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_assoc($result);
		$highestbidder=$row['name'];
	}
$date=date("Y-m-d");
$sql="SELECT * from item where itemid='$itemid' and duration>'$date';";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$check=mysqli_num_rows($result);


?>

<div class="wrapper">
	<h3 class="itemh3">Item info</h3><hr>
	<?php
	if ($check==0) {
		echo "<b>This item has expired. you can not bid on it anymore.</b><br>";
	}
	elseif (($ownerid==$id && $resultcheck==0)||($admin==1 && $resultcheck==0)) {
		echo "<form class='bidform' action='include/removeitem.php?itemid=$itemid' method='POST'>
			<button type='submit' name='remove'>Remove this item</button>
			</form>";
		if ($admin==1) {
			echo"<form class='bidform' action='include/bidding.php?itemid=$itemid&startingbid=$startingbid' method='POST'>
			<input type='text' name='money' placeholder='Place your bid'>
			<button type='submit' name='bid'>Bid</button>
			</form>";
		}
	}
	elseif ($ownerid!=$id) {
		echo"<form class='bidform' action='include/bidding.php?itemid=$itemid&startingbid=$startingbid' method='POST'>
			<input type='text' name='money' placeholder='Place your bid'>
			<button type='submit' name='bid'>Bid</button>
			</form>";
	}

	
	?>

	<p class="iteminfo">
		<?php 
			echo"Item id: $itemid<br>
			Item name: $itemname<br>
			Owned by: $owner<br>
			Owner phone no: $phone<br>
			Last date: $lastdate<br>
			Starting bid: $startingbid taka<br>";
			if($resultcheck==0){
				echo'No one has bid on this item yet.<br>';
			}else{
				echo"Highest bid: $highestbid taka<br>
				Highest bidder: $highestbidder";
				if($highestbidderid==$id){
					echo"(you)";
				}echo "<br>";

				$sql="SELECT ownbid from bidson where itemid=$itemid AND userid=$id;";
				$result=mysqli_query($conn,$sql);
				$row=mysqli_fetch_assoc($result);
				$resultcheck=mysqli_num_rows($result);
				if ($resultcheck>0){
					$yourbid=$row['ownbid'];
					echo "Your bid: $yourbid taka<br>";
				}
			}
			echo "Description: $description<hr>";
		?>	
	</p>
	<?php
	echo"<a href='$pic'><div class='itempic'><img src='$pic'></div></a>";
	?>
</div>

