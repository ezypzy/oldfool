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
