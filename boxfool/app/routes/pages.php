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
function page_contact() {
	global $app, $v, $page_template;

	$v = array_merge($v, array(
		'form_success' => false,
		'form_error' => false,
		'page' => 'page_contact'
	));

	if($app->request()->isPost()) {
		$data = $app->request()->post();
		foreach($data as $key => $value) {
			if($value == '') {
				$v['form_error'] = true;
			}
		}	
		if($v['form_error'] == false) {
			sendContactEmail($data);
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
