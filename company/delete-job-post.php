<?php
session_start();
require_once("../db.php");

//If user clicked Register button
if(isset($_POST)){


	$stmt = $conn->prepare("DELETE FROM job_post WHERE id_jobpost=? AND id_company=?");


	$stmt->bind_param("ii", $_GET['id'], $_SESSION['id_user']);
	if($stmt->execute()){
		$_SESSION['jobPostDeletedSuccess'] = true;
		header("Location: dashboard.php");
		exit();
	}
	else{
		echo "Error" . $sql . "<br>" . $conn->error;
	}

	$stmt->close();



	// $sql = "DELETE FROM job_post WHERE id_jobpost='$_GET[id]' AND id_company='$_SESSION[id_user]'";

	// if($conn->query($sql)===TRUE){
	// 	$_SESSION['jobPostDeletedSuccess'] = true;
	// 	header("Location: dashboard.php");
	// 	exit();
	// }
	// else{
	// 	echo "Error" . $sql . "<br>" . $conn->error;
	// }

		$conn->close();
}
else{
	header("Location : dashboard.php");
	exit();
}
?>