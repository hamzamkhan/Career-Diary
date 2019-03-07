<?php

//To Handle Session Variables on This Page
session_start();
//Including Database Connection From db.php file to avoid rewriting in all files
require_once("../db.php");




$sql = "SELECT * FROM job_post d,users u WHERE CONCAT('%', d.jobtitle, '%') LIKE CONCAT('%', u.interest, '%')  OR CONCAT('%', d.description, '%') LIKE CONCAT('%', u.interest, '%')";

$result = $conn->query($sql);
if($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) {

	// 	if(isset($_SESSION['id_user'])) {

	// 	$sql1 = "SELECT * FROM apply_job_post WHERE id_user='$_SESSION[id_user]' AND id_jobpost='$row[id_jobpost]'";
	// 	$result1 = $conn->query($sql1);
	// 	if($result1->num_rows > 0) 
	// 	{
	// 		$apply = "<strong>Applied</strong>";
	// 	}else {
	// 		$apply = "<a href='apply-job-post.php?id=".$row['id_jobpost']."'>Apply</a>";
	// 	}

	// }

		$apply = "<a href='../apply-job-post.php?id=".$row['id_jobpost']."'>Apply</a>";
	
		$json[] = array(
			0 => $row['jobtitle'],
			1 => $row['minimumsalary'],
			2 => $row['maximumsalary'],
			3 => $row['experience'],
			4 => $apply,
			);
    }

    echo json_encode($json);
}

