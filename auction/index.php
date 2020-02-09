<?php
session_start();
include_once('include/dbconn.php');
include_once('header.php');
$sql="SELECT pic1,name,startingbid,itemid from item ORDER BY itemid desc;";
$result=mysqli_query($conn,$sql);
?>
<div class="coverpic"><div></div></div>
<div class="homediv">
	<h3>Bid on items</h3>
</div>
<div class="wrapper">
	<div class="homeimg">
<?php
		while($row=mysqli_fetch_assoc($result)){
			$pic=$row['pic1'];
			$itemname=$row['name'];
			$startingbid=$row['startingbid'];
			$item=$row['itemid'];
			echo"<a href='item.php?id=$item'>
			<div class='ownexhibitions'>
				<img src='$pic'><br>
				<p>$itemname
				<br>Starting bid: $startingbid taka</p>
			</div></a>";
		}
	?>
	</div>
	</div>
</body>
</html>