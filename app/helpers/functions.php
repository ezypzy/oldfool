<?php
/**
 * functions file
 **/

function sendContactEmail($data) {
	$mail = new PHPMailer(true);

	$mail->IsSMTP();
	$mail->Mailer			= 'smtp';
	$mail->Host				=	"ssl://smtp.gmail.com";
	$mail->Port				=	465;
	$mail->SMTPAuth   = true;										// enable SMTP authentication
	$mail->Username   = "hello@boxfool.com";		// SMTP server username
	$mail->Password   = "b0xst4rs";

	$mail->From       = $data['contact_email'];
	$mail->FromName   = $data['contact_name'];
	$mail->AddReplyTo($data['contact_email'], $data['contact_name']);
	//$mail->AddAddress("hello@boxfool.com");
	$mail->AddAddress("hello@boxfool.com");
	$mail->Subject  = "Contact Form from ". $data['contact_location'];
	$mail->Body = $data['contact_comment'];
	$mail->WordWrap   = 80; // set word wrap

	$mail->Send();	
}

function sendResetInstruction($data) {
	$mail = new PHPMailer(true);

	$mail->IsSMTP();
	$mail->Mailer			= 'smtp';
	$mail->Host				=	"ssl://smtp.gmail.com";
	$mail->Port				=	465;
	$mail->SMTPAuth   = true;										// enable SMTP authentication
	$mail->Username   = "hello@boxfool.com";		// SMTP server username
	$mail->Password   = "b0xst4rs";

	$body = "Hello ".$data['name'].", \r\n\r\n";
	$body .= "You've told us you have forgotten your account password. No worries just click the link below to reset your password. \r\n\r\n";
	$body .= "NOTE: The link can only be used once.\r\n\r\n";
	$body .= "LINK: ".$data['random_link'];	

	$mail->From       = "hello@boxfool.com";
	$mail->FromName   = "Boxfool";
	$mail->AddReplyTo("hello@boxfool.com", "Boxfool");
	$mail->AddAddress($data['to_email']);
	$mail->Subject  = "Get New Pasword";
	$mail->Body = $body;
	$mail->WordWrap   = 80; // set word wrap

	$mail->Send();	
}
