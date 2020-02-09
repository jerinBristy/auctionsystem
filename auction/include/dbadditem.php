<?php
	session_start();
	include_once 'dbconn.php';
	$userid=$_SESSION['uid'];

	

	if (isset($_POST['exhibit'])) {
		$itemname=mysqli_real_escape_string($conn,$_POST['itemname']);
		$description=mysqli_real_escape_string($conn,$_POST['description']);
		$startingbid=mysqli_real_escape_string($conn,$_POST['startingbid']);
		$date=mysqli_real_escape_string($conn,$_POST['deadline']);

		$file=$_FILES['file'];

		$filename=$file['name'];
		$error=$file['error'];
		$filesize=$file['size'];
		$temp=$file['tmp_name'];

		$fileext=explode('.', $filename);
		$fileactualext=strtolower(end($fileext));
		$allowed=array('jpg','jpeg','png');

		if (in_array($fileactualext,$allowed)) {
			if ($error==0) {
				
				$filenamenew=uniqid('',true).".".$fileactualext;
				$filedestination='../itempic/'.$filenamenew;
				move_uploaded_file($temp, $filedestination);
				$itempic=str_replace("../", "", $filedestination);

				
				
			}else{
				echo "There was an error uploading you picture";
			}
		}else{
			echo "You can not upload .$fileactualext file";
		}






		if (empty($itemname)||empty($description)||empty($startingbid)||empty($date)) {
			header("Location: ../additem.php?item=empty");
			exit();
		}else{
			$sql="INSERT into item (name,description,ownerid,duration,startingbid,pic1) values('$itemname','$description','$userid','$date','$startingbid','$itempic');";
			mysqli_query($conn,$sql);
			$lastid=mysqli_insert_id($conn);
			header("Location: ../item.php?id=$lastid");
		}
	}
?>