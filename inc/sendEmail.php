<?php

// Replace this with your own email address
$siteOwnersEmail = 'msreed3@outlook.com';


if(!empty($_POST)) {

   $name = $_POST['contactName'];
   $email = $_POST['contactEmail'];
   $subject = $_POST['contactSubject'];
   $contact_message = $_POST['contactMessage'];

   // Check Name
	if (empty($name)) {
		$error[] = "Please enter your name.";
	}
	// Check Email
	if (empty($email)) {
		$error[] = "Please enter a valid email address.";
	}
	// Check Message
	if (empty($contact_message)) {
		$error[] = "Please enter your message. It should have at least 15 characters.";
	}
   // Subject
	if (empty($subject == '')) {
	    $empty[] = "Contact Form Submission";
	}


   // Set Message
   $message .= "Email from: " . $name . "<br />";
	$message .= "Email address: " . $email . "<br />";
   $message .= "Message: <br />";
   $message .= $contact_message;
   $message .= "<br /> ----- <br /> This email was sent from your site's contact form. <br />";

   // Set From: header
   $from =  $name . " <" . $email . ">";

   // Email Headers
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: ". $email . "\r\n";
 	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


   if (!$error) {

      ini_set("sendmail_from", $siteOwnersEmail); // for windows server
      $mail = mail($siteOwnersEmail, $subject, $message, $headers);

		if ($mail) { echo "OK"; }
      else { echo "Something went wrong. Please try again."; }
		
	} # end if - no validation error

	else {

		$response = (isset($error['name'])) ? $error['name'] . "<br /> \n" : null;
		$response .= (isset($error['email'])) ? $error['email'] . "<br /> \n" : null;
		$response .= (isset($error['message'])) ? $error['message'] . "<br />" : null;
		
		echo $response;

	} # end if - there was a validation error

}

?>