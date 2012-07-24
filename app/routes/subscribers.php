<?php


// -- account login page
$app->map('/account/login', 'account_login')->via('GET', 'POST');
function account_login() {
	global $app, $v, $user_sess, $base_template;
	
	if($user_sess->logged_in) {
		$app->redirect('/account');
	}

	$v['form_error'] = false;
	$v['form_success'] = false;

	// -- process login
	if($app->request()->isPost()) {
		$email = $app->request()->post('email');
		$password = $app->request()->post('password');
		$user = ORM::for_table('subscribers')
			->where('email', $email)
			->where('password', sha1($password))
			->find_one();

		if($user == false) {
			$v['form_error'] = true;
		} else {
			$user_sess->create($user->id);
			$v['form_success'] = true;
			$app->redirect('/account');
		}
	}

	$v['page'] = 'account_login';
	$app->render($base_template, $v);
}

// -- account detail page
$app->get('/account/', 'account_details');
function account_details() {
	global $app, $v, $user_sess, $page_template;
	
	if(!$user_sess->logged_in) {
		$app->redirect('/account/login');
	}

	$subscriber = ORM::for_table('subscribers')->find_one($user_sess->user_id);

	$v['user_info'] = array(
		'name' => $subscriber->name,
		'email' => $subscriber->email,
		'tel' => $subscriber->tel,
		'address1' => $subscriber->address_1,
		'address2' => $subscriber->address_2,
		'address3' => $subscriber->address_3,
		'postcode' => $subscriber->postcode,
		'city' => $subscriber->city,
		'state' => $subscriber->state,
		'country' => $subscriber->country
	);

	$v['page'] = "account_details";
	$app->render($page_template, $v);	
}
