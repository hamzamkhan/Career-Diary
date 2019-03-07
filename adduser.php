<?php
session_start();
require_once("db.php");

//If user clicked Register button
if(isset($_POST)){

	//Escape Special Characters in String First
	$firstname = mysqli_real_escape_string($conn, $_POST['fname']);
	$lastname = mysqli_real_escape_string($conn, $_POST['lname']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	$city = mysqli_real_escape_string($conn, $_POST['city']);
	$state = mysqli_real_escape_string($conn, $_POST['state']);
	$contactno = mysqli_real_escape_string($conn, $_POST['contactno']);
	$qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
	$stream = mysqli_real_escape_string($conn, $_POST['stream']);
	$passingyear = mysqli_real_escape_string($conn, $_POST['passingyear']);
	$dob = mysqli_real_escape_string($conn, $_POST['dob']);
	$age = mysqli_real_escape_string($conn, $_POST['age']);
	$designation = mysqli_real_escape_string($conn, $_POST['designation']);
	$aboutme = mysqli_real_escape_string($conn, $_POST['aboutme']);
	$skills = mysqli_real_escape_string($conn, $_POST['skills']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$interest = mysqli_real_escape_string($conn, $_POST['interest']);
	$fblink = mysqli_real_escape_string($conn, $_POST['fblink']);
	$llink = mysqli_real_escape_string($conn, $_POST['llink']);

	

	//Encrypt Password
	$password = base64_encode(strrev(md5($password)));

	$sql = "SELECT email FROM users WHERE email='$email'";
	$result = $conn->query($sql);
	if($result->num_rows==0)
	{ 

		$uploadOk = true;

	$folder_dir = "uploads/resume/";

	$base = basename($_FILES['resume']['name']);

	$resumeFileType = pathinfo($base, PATHINFO_EXTENSION);

	$file = uniqid() . "." . $resumeFileType;

	$filename = $folder_dir .$file; // This is the location for saving our file.

	if(file_exists($_FILES['resume']['tmp_name'])) { // tmp_name = server temp location 

		if($resumeFileType == "pdf") {
			if($_FILES['resume']['size'] < 500000) { //File size < 5MB
				move_uploaded_file($_FILES['resume']['tmp_name'], $filename);
			} else {
				$_SESSION['uploadError'] = "Wrong Size. Max Size Allowed : 5MB.";
				$uploadOk = false;
			}
		} else {

			$_SESSION['uploadError'] = "Wrong Format. Only PDF Allowed.";
			$uploadOk = false;

		}
	} else {
		$_SESSION['uploadError'] = "Something Went Wrong. File Not Uploaded. Try Again/";
		$uploadOk = false;
	}

	if($uploadOk == false) {
		header("Location: register-candidates.php");
		exit();
	}

		$hash = md5(uniqid());
	


		$sql = "INSERT INTO users(firstname, lastname, email, password, address, city, state, contactno, qualification, stream, passingyear, dob, age, designation,interest, resume, hash, aboutme,fblink,llink,skills) VALUES ('$firstname', '$lastname', '$email', '$password', '$address', '$city', '$state', '$contactno', '$qualification', '$stream', '$passingyear', '$dob', '$age', '$designation','$interest','$file','$hash', '$aboutme', '$fblink','$llink','$skills')";

		if($conn->query($sql)===TRUE){

			//Send Email
			// require 'vendor/PHPMailerAutoload.php';
			// require 'credentials.php';

			// $mail = new PHPMailer;

			// // $mail->SMTPDebug = 1;                               // Enable verbose debug output

			// $mail->isSMTP();                                      // Set mailer to use SMTP
			// $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			// $mail->SMTPAuth = true;                               // Enable SMTP authentication
			// $mail->Username = EMAIL;                 // SMTP username
			// $mail->Password = PASS;                           // SMTP password
			// $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			// $mail->Port = 587;                                    // TCP port to connect to

			// $mail->setFrom(EMAIL,'Career Diary');
			// $mail->addAddress($_POST['email']);     // Add a recipient
			
			// $mail->addReplyTo(EMAIL);
			// // $mail->addCC('cc@example.com');
			// // $mail->addBCC('bcc@example.com');

			// // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			// $mail->isHTML(true);                                  // Set email format to HTML

			// $mail->Subject = 'Verify Your Account on Career Diary';
			// $mail->Body    = '<p>Click Link To Confirm</p>
			// 	<a href = "www.fizzabid97.000webhostapp.com/verify.php?token='.$hash.'&email='.$email.'">Verify Email</a>';
			// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			// if($mail->send()) {
			    $_SESSION['registerCompleted'] = true;
				header("Location: login.php");
				exit();
			}

			// if($result === TRUE) {

				

			// }

		else{
			echo "Error " . $sql . "<br>" . $conn->error;
		}
		}
	

	else
	{
		$_SESSION['registerError'] = true;
		header("Location: register-candidates.php");
		exit();
	}
} 
else{
	header("Location: register-candidates.php");
	exit();
}
?>