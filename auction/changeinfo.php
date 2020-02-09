<?php
session_start();
include_once('include/dbconn.php');
include_once('header.php');
?>
<div class="wrapper">
	<div class="change">
		<form action="include/changename.php" method="POST">
			<input type="text" name="name" placeholder="enter new name"><br>
			<button type="submit" name="changename">Change name</button><br>
		</form>
		<form action="include/changeemail.php" method="POST">
			<input type="text" name="email" placeholder="enter new email"><br>
			<button type="submit" name="changeemail">Change email</button><br>
		</form>
		<form action="include/changephone.php" method="POST">
			<input type="text" name="phone" placeholder="enter new phone no"><br>
			<button type="submit" name="changephone">Change phone</button><br>
		</form>
		<form action="include/changeaddress.php" method="POST">
			<input type="text" name="address" placeholder="enter new address"><br>
			<button type="submit" name="changeaddress">Change address</button><br>
		</form>
		<form action="include/changepass.php" method="POST">
			<input type="text" name="oldpass" placeholder="enter old password"><br>
			<input type="text" name="newpass" placeholder="enter new password"><br>
			<button type="submit" name="changepass">Change password</button><br>
		</form>

	</div>
</div>


