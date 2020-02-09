<?php
	session_start();
	if (isset($_POST['signup'])) {
		
		include_once 'dbconn.php';

		$name=mysqli_real_escape_string($conn,$_POST['name']);
		$email=mysqli_real_escape_string($conn,$_POST['email']);
		$pass=mysqli_real_escape_string($conn,$_POST['pass']);
		$repass=mysqli_real_escape_string($conn,$_POST['repass']);
		$phone=mysqli_real_escape_string($conn,$_POST['phone']);
		$address=mysqli_real_escape_string($conn,$_POST['address']);

		if (empty($name)||empty($email)||empty($pass)||empty($repass)||empty($phone)||empty($address)) {
			header("Location: ../signup.php?signup=empty");
			exit();

		}
		//checking if name is valid
		else{
			if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
				header("Location: ../signup.php?signup=invalidname");
				exit();
			}elseif (!preg_match("/^[0-9]*$/", $phone)) {
				//checking if phone no is valid
				header("Location: ../signup.php?signup=invalidphoneno");
				exit();
			}
			//checking if email is valid
			else{
				if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
					header("Location: ../signup.php?signup=invalidemail");
					exit();
				}else{
				//prepared statement for selecting email
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

						if ($resultcheck>0) {
							header("Location: ../signup.php?signup=emailtaken");
							exit();
						}else{
							if($pass!=$repass) {
								//matching pass and repass
								header("Location: ../signup.php?signup=passwordmismatch");
								exit();
							}else{
								//hashing pass
								$hpass=password_hash("$pass",PASSWORD_DEFAULT);

								//inserting data into user
								$sql="INSERT into user (name,pass,phone,address,email) values(?,?,?,?,?);";

								$stmt=mysqli_stmt_init($conn);
								if(!mysqli_stmt_prepare($stmt,$sql)){
									header("Location: ../signup.php?signup=sqlerror");
									exit();
								}else{
									mysqli_stmt_bind_param($stmt,"sssss",$name,$hpass,$phone,$address,$email);
									mysqli_stmt_execute($stmt);
									$sql="SELECT lastInserId();";
									$_SESSION['uid']=mysqli_query($conn,$sql);
									$_SESSION['uemail']=$email;
									
									header("Location: ../index.php?signup=success");
									exit();
								}
							}

						}
					}

				}
			}
		}
	}else{
		header("Location: ../signup.php");
		exit();
	}