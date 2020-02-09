<?php
	include_once('profile.php');
	$sql="SELECT b.itemid,i.name as itemname,i.startingbid,i.pic1 from bidson b,item i where b.userid=$id AND b.itemid=i.itemid ORDER BY itemid desc;";
	$result=mysqli_query($conn,$sql);
	$resultcheck=mysqli_num_rows($result);
	if ($resultcheck==0) {
		echo"<div class='wrapper'> You have not bid on any items</div>";
	}

	while($row=mysqli_fetch_assoc($result)){
		$itemname=$row['itemname'];
		$startingbid=$row['startingbid'];
		$itemid=$row['itemid'];
		$pic=$row['pic1'];

		echo"<div class='wrapper'>
		<a href='item.php?id=$itemid'>
			<div class='ownexhibitions'>
				<img src='$pic'><br>
				<p>$itemname
				<br>Starting bid: $startingbid taka</p>
			</div></a></div>";
	}