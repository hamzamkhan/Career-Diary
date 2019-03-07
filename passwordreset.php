<?php
session_start();
require_once("db.php");

//If user clicked Register button
if(isset($_POST)){

	//Escape Special Characters in String First
	$email = mysqli_real_escape_string($conn, $_POST['email']);

	

	$sql = "SELECT email FROM users WHERE email='$email'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
	{ 
		$newPass = rand(10000,99999); //generate 5 digit password 
		//Encrypt Password
		$password = base64_encode(strrev(md5($newPass)));

		$sql = "UPDATE users SET password='$password' WHERE email='$email'";

		if($conn->query($sql)===TRUE){

			//Se nd Email
			// $to = $email;
			// $subject = "Career Diary - Password Reset";
			// $message = '

			// <html>
			// <head>
			// 	<title>Your Password Has Been Reset.</title>
			// <body>
			// 	<p>Your New Password Is  - '.$newPass.'</p>
			// 	<a href = "www.yourdomain.com/verify.php?token='.$wePass. '">Verify Email</a>
			// </body>
			// </html>

			// ';

			// $headers[] = 'MIME-VERSION: 1.0';
			// $headers[] = 'Content-type: text/html; charset=iso-8859-1';
			// $headers[] = 'To: '.$to;
			// $headers[] = 'From: yourdoman@domain.com';


			// $result = mail($to, $subject, $message, implode("\r\n",$headers)); // \r\n returns new line


			// if($result === TRUE) {

			// 	$_SESSION['passwordChanged'] = true;
			// 	header("Location: login.php");
			// 	exit();

			// }

			$_SESSION['passwordChanged'] = $newPass;
			header("Location: forgot-password.php");
			exit();
		}
		else{
			echo "Error " . $sql . "<br>" . $conn->error;
		}
	}

	else
	{
		//If email not found in the database
		$_SESSION['emailNotFoundError'] = true;
		header("Location: forgot-password.php");
		exit();
	}
}
else{
	//redirect to forgot-password.php if "Forgot Password" button not clicked
	header("Location: forgot-password.php");
	exit();
}
?>