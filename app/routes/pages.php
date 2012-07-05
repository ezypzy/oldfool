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
$app->get('/contact/', 'page_contact');
function page_contact()
{
	global $app, $v, $page_template;

	$v = array_merge($v, array(
		'page' => 'page_contact'
	));

	$app->render($page_template, $v);
}

