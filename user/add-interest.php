<?php
session_start();

require_once("../db.php");

//If user clicked Register button
if(isset($_POST)){

	$interest = mysqli_real_escape_string($conn, $_POST['interest']);
	$sql = "UPDATE users SET interest='$interest' WHERE id_user='$_SESSION[id_user]'";

	if($conn->query($sql) === TRUE){
		header("Location: resume.php");
		exit();
	}
	else{
		echo "Error ". $sql . "<br>" . $conn->error;
	}
	$conn->close();
}
else {
	header("Location: resume.php");
	exit();
}
?>