<?php
session_start();
require_once("../db.php");

//If user clicked Register button
if(isset($_POST)){


	$stmt = $conn->prepare("UPDATE job_post SET jobtitle=?, description=?, minimumsalary=?, maximumsalary=?, experience=?, qualification=? WHERE id_jobpost=? AND id_company=?");

	$stmt->bind_param("ssssssii", $jobtitle, $description, $minimumsalary, $maximumsalary, $experience, $qualification, $_POST['target_id'], $_SESSION['id_user']);

	//Escape Special Characters in String First
	$jobtitle = mysqli_real_escape_string($conn, $_POST['jobtitle']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$minimumsalary = mysqli_real_escape_string($conn, $_POST['minimumsalary']);
	$maximumsalary = mysqli_real_escape_string($conn, $_POST['maximumsalary']);
	$experience = mysqli_real_escape_string($conn, $_POST['experience']);
	$qualification = mysqli_real_escape_string($conn, $_POST['qualification']);

	if($stmt->execute()){
		$_SESSION['jobPostUpdateSuccess'] = true;
		header("Location: dashboard.php");
		exit();
	}
	else{
		echo "Error" . $sql . "<br>" . $conn->error;
	}

	$stmt->close();

	// $sql = "UPDATE job_post SET jobtitle='$jobtitle' , description='$description', minimumsalary='$minimumsalary', maximumsalary='$maximumsalary', experience='$experience', qualification='$qualification' WHERE id_jobpost='$_POST[target_id]' AND id_company='$_SESSION[id_user]'";

	// if($conn->query($sql)===TRUE){
	// 	$_SESSION['jobPostUpdateSuccess'] = true;
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