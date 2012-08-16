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
$app->map('/contact/', 'page_contact')->via('POST', 'GET');
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

		//$email_to = "hello@boxfool.com";
		$email_to = "jibone@gmail.com";
		$email_subject = "Contact form";
		$email_message = "Email from contact form, \r\n\r\n";
		$email_message .= "Name: {$name}\r\n";
		$email_message .= "Email: {$email}\r\n\r\n";
		$email_message .= "Location: {$location}\r\n";
		$email_message .= "Message:\r\n";
		$email_message .= $comment ."\r\n\r\n";
		$email_header = "From: {$email}\r\n";
		if (!mail($email_to, $email_subject, $email_message, $email_header)) {
			die("Cannot send mail.");
		} else {
			$v['form_success'] = true;
		}
	}

	$app->render($page_template, $v);
}

// -- ideas page
$app->get('/ideas/', 'page_ideas');
function page_ideas() {
	global $app, $v, $page_template;

	$v['page'] = "page_ideas";
	$app->render($page_template, $v);
}


// -- generic blogger page
$app->get('/bloggers/', 'page_bloggers');
function page_bloggers() {
	global $app, $v, $page_template;

	$v['page'] = "page_bloggers";
	$app->render($page_template, $v);
}
