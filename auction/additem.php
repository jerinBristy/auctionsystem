<?php
session_start();
include_once('include/dbconn.php');
include_once('header.php');
$userid=$_SESSION['uid'];

?>

<div class="wrapper">
		<div class="additem">
			<h1>Add item</h1>
			
			<form action="include/dbadditem.php" method="POST" enctype="multipart/form-data">
				<input type="text" name="itemname" placeholder="Name of your item"><br>
				<textarea name="description" placeholder="Item description (eg. item model, version etc)"></textarea><br>
				<input type="text" name="startingbid" placeholder="Starting Bid"><br>
				Last date: <input type="text" name="deadline" placeholder="year-month-day"><br>
				<p>upload an item pic</p>
				<input type="file" name="file"><br>
				<button type="submit" name="exhibit">Exhibit</button>
			</form>
		</div>
	</div>

	