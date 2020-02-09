<?php
	include_once('profile.php');
	$sql="SELECT pic1,name,startingbid,itemid from item where ownerid=? ORDER BY itemid desc;";
	$ownerid=$_SESSION['uid'];
	$stmt=mysqli_stmt_init($conn);
	if(mysqli_stmt_prepare($stmt,$sql)){
		mysqli_stmt_bind_param($stmt,"i",$ownerid);
		mysqli_stmt_execute($stmt);

		$result=mysqli_stmt_get_result($stmt);
		//$row=mysqli_fetch_assoc($result);
	}
?>
<div class="wrapper">
	<form action="additem.php" method="POST">
		<button type="submit" name="additem"> add item</button>
	</form>
	
	<?php
		while($row=mysqli_fetch_assoc($result)){
			$pic=$row['pic1'];
			$itemname=$row['name'];
			$startingbid=$row['startingbid'];
			$itemid=$row['itemid'];
			echo"<a href='item.php?id=$itemid'>
			<div class='ownexhibitions'>
				<img src='$pic'><br>
				<p>$itemname
				<br>Starting bid: $startingbid taka</p>
			</div></a>";
		}
	?>
</div>