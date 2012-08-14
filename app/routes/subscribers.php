<?php


// -- account login page
$app->map('/account/login/', 'account_login')->via('GET', 'POST');
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
	
	$v['form_error'] = false;
	$v['form_success'] = false;
	$v['form_submit'] = false;	

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


// -- update user details
$app->map('/account/update/details/', 'account_update_details')->via('GET', 'POST');
function account_update_details() {
	global $app, $v, $user_sess, $page_template;

	if(!$user_sess->logged_in) {
		$app->redirect('/account/login');
	}

	$v['form_error'] = false;
	$v['form_submit'] = false;
	$v['form_success'] = false;

	$v['form_error_name'] = false;
	$v['form_error_email'] = false;
	$v['form_error_tel'] = false;

	$subscriber = ORM::for_table('subscribers')->find_one($user_sess->user_id);

	$v['input'] = array(
		'name' => $subscriber->name,
		'email' => $subscriber->email,
		'tel' => $subscriber->tel
	);

	if($app->request()->isPost()) {
		$v['input']['name'] = $app->request()->post('name');
		$v['input']['email'] = $app->request()->post('email');
		$v['input']['tel'] = $app->request()->post('tel');
		
		if($v['input']['name'] == '') {
			$v['form_error'] = true;
			$v['form_error_name'] = true;
		}

		if($v['input']['email'] == '') {
			$v['form_error'] = true;
			$v['form_error_email'] = true;
		}

		if($v['input']['tel'] == '') {
			$v['form_error'] = true;
			$v['form_error_tel'] = true;
		}

		if(!v::email($v['input']['email'])) {
			$v['form_error'] = true;
			$v['form_error_email'] = true;
		}

		if($v['form_error'] == false) {
			$sub = ORM::for_table('subscribers')->find_one($user_sess->user_id);
			$sub->name = $v['input']['name'];
			$sub->email = $v['input']['email'];
			$sub->tel = $v['input']['tel'];
			$sub->save();
			$v['form_success'] = true;
		}
	}

	$v['page'] = "account_update_details";
	$app->render($page_template, $v);
}


// -- update shiping address
$app->map('/account/update/address/', 'account_update_address')->via('GET', 'POST');
function account_update_address() {
	global $app, $v, $user_sess, $page_template;

	if(!$user_sess->logged_in) {
		$app->redirect('/account/login');
	}

	$v['form_error'] = false;
	$v['form_success'] = false;
	$v['form_submit'] = false;

	$v['form_error_address1'] = false;
	$v['form_error_address2'] = false;
	$v['form_error_address3'] = false;
	$v['form_error_postcode'] = false;
	$v['form_error_city'] = false;
	$v['form_error_state'] = false;
	$v['form_error_country'] = false;


	$subscriber = ORM::for_table('subscribers')->find_one($user_sess->user_id);
	
	$v['input'] = array(
		'address1' => $subscriber->address_1,
		'address2' => $subscriber->address_2,
		'address3' => $subscriber->address_3,
		'postcode' => $subscriber->postcode,
		'city' => $subscriber->city,
		'state' => $subscriber->state,
		'country' => $subscriber->country
	);

	if($app->request()->isPost()) {
		$v['input'] = array(
			'address1' => $app->request()->post('address1'),
			'address2' => $app->request()->post('address2'),
			'address3' => $app->request()->post('address3'),
			'postcode' => $app->request()->post('postcode'),
			'city' => $app->request()->post('city'),
			'state' => $app->request()->post('state'),
			'country' => $app->request()->post('country')
		);

		$i = 0;
		foreach($v['input'] as $key => $value) {
			$v['form_error_'.$key] = '';
			if( $key != 'submit' &&
					$key != 'address2' &&
					$key != 'address3' &&
					trim($value) == null ) {
				$v['form_error_list'][$i] = array(
					'field' => $key,
					'message' => ucfirst($key) . ' is empty.'
				);
				$v['form_error_'.$key] = 'error';
				$v['form_error'] = true;
			}	
			$i++;	
		}

		$sub = ORM::for_table('subscribers')->find_one($user_sess->user_id);
		$sub->address_1 = $v['input']['address1'];
		$sub->address_2 = $v['input']['address2'];
		$sub->address_3 = $v['input']['address3'];
		$sub->postcode = $v['input']['postcode'];
		$sub->city = $v['input']['city'];
		$sub->state = $v['input']['state'];
		$sub->country = $v['input']['country'];
		if($sub->save()) {
			$v['form_success'] = true;
		} else {
			$v['form_error'] = true;
			$v['form_error_database'] = true;
		}

	}	
	
	$v['page'] = "account_update_address";
	$app->render($page_template, $v);
}


// -- change password
$app->map('/account/change/password', 'account_change_password')->via('GET', 'POST');
function account_change_password() {
	global $app, $v,$user_sess, $page_template;

	if(!$user_sess->logged_in) {
		$app->redirect('/account/login');
	}

	$v['form_error'] = false;
	$v['form_success'] = false;
	$v['form_submit'] = false;

	$v['page'] = "account_change_password";
	$app->render($page_template);
}