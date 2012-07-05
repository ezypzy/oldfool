<?php
/**
 * pages controller
 *
 * app/routes/boxes.php
 **/


// -- routes to about page
$app->get('/about/', 'page_about');
function page_about()
{
	global $app, $v, $page_template;

	$v = array_merge($v, array(
		'page' => 'page_about'
	));

	$app->render($page_template, $v);
}


// -- routes to faq page
$app->get('/faq/', 'page_faq');
function page_faq() 
{
	global $app, $v, $page_template;

	$v = array_merge($v, array(
		'page' => 'page_faq'
	));	

	$app->render($page_template, $v);
}


// -- routes to contact page
$app->map('/contact/', 'page_contact')->via('GET', 'POST');
function page_contact()
{
	global $app, $v, $page_template;

	$v = array_merge($v, array(
		'form_success' => false,
		'page' => 'page_contact'
	));

	if($app->request()->isPost()) {
		$name = $app->request()->post('contact_name');
		$email = $app->request()->post('contact_email');
		$location = $app->request()->post('contact_location');
		$comment = $app->request()->post('contact_comment'); 

		//$email_to = "whatsup@boxfool.com";
		$email_to = "jibone@gmail.com";
		$email_subject = "Contact form";
		$email_message = "Email from contact form, \r\n\r\n";
		$email_message .= "Name: {$name}\r\n";
		$email_message .= "Email: {$email}\r\n\r\n";
		$email_message .= "location: {$location}\r\n";
		$email_message .= "Message:\r\n";
		$email_message .= $comment ."\r\n\r\n";
		mail($email_to, $email_subject, $email_message);
		$v['form_success'] = true;
	}

	$app->render($page_template, $v);
}

