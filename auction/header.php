</!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Auction</title>
	<link rel="stylesheet" type="text/css" href="style/style.css"/>
	<link rel="shortcut icon" type="image/jpg" href="auction.png">
</head>
<body>
	<header class="upper">
		<div class="wrapper">
			<ul id="sign">
				<?php

					if (isset($_SESSION['uid'])) {
						echo '<form action="include/logout.php" method="POST">
						<button type="submit" name="logout" >logout</button>
						</form>';
					}else{
						echo '<a href="signup.php">sign up </a> /
			  			<a href="login.php"> log in</a>';
					}

				?>
			</ul>
		</div>
	</header>

	<header class="lower">
		
		<div class="wrapper">
			<nav class="mainnav">
				<ul>
					<li><a href="index.php">Home</a></li>
					<?php

						if (isset($_SESSION['uid'])) {
							echo '<li><a href="Profile.php">Profile</a></li>';
							if ($_SESSION['admin']==1) {
								echo '<li><a href="user.php">Users</a></li>';
							}
						}

					?>
				</ul>
			</nav>
		</div>
	</header>