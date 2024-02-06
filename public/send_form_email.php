<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\ PHPMailer\ PHPMailer;
use PHPMailer\ PHPMailer\ Exception;

if ( isset( $_POST[ 'email' ] ) ) {

	// EDIT THE 2 LINES BELOW AS REQUIRED
	$email_to = "nblaurenciana@gmail.com";
	$email_subject = "Inquiry from Website";

	function died( $error ) {
		// your error code can go here
		echo "We are very sorry, but there were error(s) found with the form you submitted. ";
		echo "These errors appear below.<br /><br />";
		echo $error . "<br /><br />";
		echo "Please go back and fix these errors.<br /><br />";
		die();
	}


	// validation expected data exists
	if ( !isset( $_POST[ 'first_name' ] ) ||
		!isset( $_POST[ 'last_name' ] ) ||
		!isset( $_POST[ 'email' ] ) ||
		!isset( $_POST[ 'telephone' ] ) ||
		!isset( $_POST[ 'comments' ] ) ) {
		died( 'We are sorry, but there appears to be a problem with the form you submitted.' );
	}



	$first_name = $_POST[ 'first_name' ]; // required
	$last_name = $_POST[ 'last_name' ]; // required
	$email_from = $_POST[ 'email' ]; // required
	$telephone = $_POST[ 'telephone' ]; // not required
	$comments = $_POST[ 'comments' ]; // required

	$error_message = "";
	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

	if ( !preg_match( $email_exp, $email_from ) ) {
		$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
	}

	$string_exp = "/^[A-Za-z .'-]+$/";

	if ( !preg_match( $string_exp, $first_name ) ) {
		$error_message .= 'The First Name you entered does not appear to be valid.<br />';
	}

	if ( !preg_match( $string_exp, $last_name ) ) {
		$error_message .= 'The Last Name you entered does not appear to be valid.<br />';
	}

	if ( strlen( $comments ) < 2 ) {
		$error_message .= 'The Comments you entered do not appear to be valid.<br />';
	}

	if ( strlen( $error_message ) > 0 ) {
		died( $error_message );
	}

	$email_message = "Form details below." . "<br /><br />";


	function clean_string( $string ) {
		$bad = array( "content-type", "bcc:", "to:", "cc:", "href" );
		return str_replace( $bad, "", $string );
	}



	$email_message .= "First Name: " . clean_string( $first_name ) . "<br />";
	$email_message .= "Last Name: " . clean_string( $last_name ) . "<br />";
	$email_message .= "Email: " . clean_string( $email_from ) . "<br />";
	$email_message .= "Telephone: " . clean_string( $telephone ) . "<br />";
	$email_message .= "Comments: " . clean_string( $comments );


	//Load Composer's autoloader
	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$mail = new PHPMailer( true ); // Passing `true` enables exceptions
	try {
		//Server settings
		$mail->SMTPDebug = 1; // Enable verbose debug output
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = 'nblaurenciana@gmail.com'; // SMTP username
		$mail->Password = 'NBL541047_google'; // SMTP password
		$mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 465; // TCP port to connect to

		//Recipients
		$mail->setFrom( 'nblaurenciana@gmail.com', 'Admin' );
		$mail->addAddress( $email_to ); // Add a recipient

		//Content
		$mail->isHTML( true ); // Set email format to HTML
		$mail->Subject = $email_subject;
		$mail->Body = $email_message;

		$mail->send();

		echo 'Message Sent!';
	} catch ( Exception $e ) {
		echo 'Message not sent!';
	}
	?>

	<?php

}
?>