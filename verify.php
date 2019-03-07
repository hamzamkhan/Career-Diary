<?php
session_start();
require_once("db.php");

if(isset($_GET)){

	//Escape Special Characters in String First
	$hash = mysqli_real_escape_string($conn, $_GET['token']);
	$email = mysqli_real_escape_string($conn, $_GET['email']);

	

	$sql = "SELECT * FROM users WHERE email='$email' AND hash='$hash'";
	$result = $conn->query($sql);
	if($result->num_rows>0)
	{
		$row = $result->fetch_assoc();
		if($row['active'] == '1') {
			echo 'You Have Already Activated Your Account';
		} else {
			$sql1 = "UPDATE users SET active='1' WHERE email='$email' AND hash='$hash'";
			if($conn->query($sql1)) {
				$_SESSION['userActivated'] = true;
				header("Location: login.php");
				exit();
			}
		}


	} else {
		echo 'Token Mismatch!';

	}

}