<?php
include_once('header.php');
?>
	<div class="wrapper">
		<div class="login">
			<h1>Login</h1>
			<form action="include/dblogin.php" method="POST">
				<input type="text" name="email" placeholder="E-mail"><br>
				<input type="password" name="pass" placeholder="Password">
				<button type="submit" name="login">log in</button>
			</form>
		</div>
	</div>
</body>
</html>