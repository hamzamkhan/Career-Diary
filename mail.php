if($conn->query($sql)===TRUE){

			//Send Email
			$to = $email;
			$subject = "Career Diary - Confirm Your Email Address";
			$message = '

			<html>
			<head>
				<title>Confirm Your Email</title>
			<body>
				<p>Click Link To Confirm</p>
				<a href = "www.fizzabid97.000webhostapp.com/verify.php?token='.$hash.'&email='.$email.'">Verify Email</a>
			</body>
			</html>

			';

			$headers[] = 'MIME-VERSION: 1.0';
			$headers[] = 'Content-type: text/html; charset=iso-8859-1';
			$headers[] = 'To: '.$to;
			$headers[] = 'From: admin@fizzabid97.000webhostapp.com';


			$result = mail($to, $subject, $message, implode("\r\n",$headers)); // \r\n returns new line


			if($result === TRUE) {

				$_SESSION['registerCompleted'] = true;
				header("Location: login.php");
				exit();

			}

			$_SESSION['registerCompleted'] = true;
			header("Location: login.php");
			exit();
		}