<?php
session_start();
	if (isset($_POST['login'])) {
		include_once 'dbconn.php';

		$email=mysqli_real_escape_string($conn,$_POST['email']);
		$pass=mysqli_real_escape_string($conn,$_POST['pass']);

		//check if inputs are empty
		if (empty($email)||empty($pass)) {
			header("Location: ../login.php?login=empty");
			exit();
		}else{
			$sql="SELECT * from user where email=?;";
			$stmt=mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt,$sql)){
				header("Location: ../signup.php?signup=sqlerror");
				exit();
			}else{
				mysqli_stmt_bind_param($stmt,"s",$email);
				mysqli_stmt_execute($stmt);

				$result=mysqli_stmt_get_result($stmt);
				$resultcheck=mysqli_num_rows($result);

				if ($resultcheck<1) {
					header("Location: ../login.php?login=error");
					exit();
				}else{
					$row=mysqli_fetch_assoc($result);
					$passcheck=password_verify($pass,$row['pass']);
					if ($passcheck==false) {
						header("Location: ../login.php?login=error");
						exit();
					}elseif ($passcheck==true) {
						$_SESSION['uid']=$row['userid'];
						$_SESSION['uname']=$row['name'];
						$_SESSION['uphone']=$row['phone'];
						$_SESSION['uaddress']=$row['address'];
						$_SESSION['uemail']=$row['email'];
						$_SESSION['admin']=$row['adminflag'];
						header("Location: ../index.php?login=success");
						exit();
					}
				}
			}
		}
	}else{
		header("Location: ../login.php");
		exit();
	}
	?>