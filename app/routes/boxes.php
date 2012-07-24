<?php
/**
 * boxes controller
 *
 * app/routes/boxes.php
 **/

$app->get('/boxes/', 'boxes_list');
function boxes_list() {
    global $app, $v;
    echo 'list of boxes';
}


// --  page for boxes
$app->get('/:box_name/', 'box_name_show');
function box_name_show($box_name, $s = '') {
    global $app, $v, $base_template, $page_template;

    //maybe this should be in config?
    //$valid_box_names    =   array('his','hers');

    // verify that box name exist
    $box = ORM::for_table('boxthemes')
        ->where('name', strtolower($box_name))
        ->find_one();

    if($box == false) {
        $v['page'] = 'error';
        $app->render($page_template, $v);
    } else{
        $v  =   array_merge($v, array(
            'box_description'   =>  $box->description,
            'box_hashtag'       =>  $box->hashtag,
            'box_name'          =>  $box_name,
            'box_price'         =>  $box->price,
            'page'              =>  'boxstar',
        ));
        $app->render($page_template, $v);
    }
}


$app->map('/:box_theme/subscribe/', 'box_subscribe_process')->via('POST', 'GET');
function box_subscribe_process($box_theme) {
	global $app, $v, $user_sess, $page_template;
	
	$box_theme = ORM::for_table('boxthemes')
		->where('name', $box_theme)
		->find_one();

	if($box_theme == 'false') {
		$v['page'] = 'error';
	} else {
		$v['form_submit'] = false;
		$v['form_error'] = false;
		$v['show_paypal_form'] = false;
		$v['box_theme'] = array(
			'name' => strtoupper($box_theme->name),
			'description' => $box_theme->description,
			'price' => $box_theme->price
		);

		if($app->request()->isPost()) {
			if($_POST) {
				$v['form_submit'] = true;
				$v['input_data'] = $input = $_POST;
				$i = 0;

				foreach($input as $key => $value) {
					$v['form_error_'.$key] = '';
					if(	$key != 'submit' &&
							$key != 'address2'	&&
							$key != 'address3' &&
							trim($value) == null) {
						$v['form_error_list'][$i] = array(
							'field' => $key, 
							'message' => ucfirst($key) . ' is empty.'
						);
						$v['form_error_'.$key] = 'error';
						$v['form_error'] = true;
					}

					if($key == 'email' && $v['form_error'] == false) {
						if(!v::email($value)) {
							$v['form_error_list'][$i] = array(
								'field' => $key, 
								'message' => 'Email syntax is incorrect.'
							);
							$v['form_error_'.$key] = 'error';
							$v['form_error'] = true;
						}
					}
					$i++;
				}
			}
			
			$v['input_data'] = array(
				'name' => $app->request()->post('name'),
				'email' => $app->request()->post('email'),
				'tel' => $app->request()->post('tel'),
				'address1' => $app->request()->post('address1'),
				'address2' => $app->request()->post('address2'),
				'address3' => $app->request()->post('address3'),
				'postcode' => $app->request()->post('postcode'),
				'city' => $app->request()->post('city'),
				'state' => $app->request()->post('state'),
				'country' => $app->request()->post('country'),
			);

			// -- check for duplicate email
			$s = ORM::for_table('subscribers')
				->where('email', $v['input_data']['email'])
				->find_one();
			if($s != false) {
				$v['form_error'] = true;
				$v['form_error_email'] = 'error';
				$v['form_error_list'][$i] = array(
					'field' => 'email',
					'message' => "Email is already registered."
				);
			}

			// -- create subscriber entry
			if($v['form_error'] == false) {
				// create random password [TODO]
				$sub = ORM::for_table('subscribers')->create();
				$sub->name = $v['input_data']['name'];
				$sub->email = $v['input_data']['email'];
				$sub->tel = $v['input_data']['tel'];
				$sub->address_1 = $v['input_data']['address1'];
				$sub->address_2 = $v['input_data']['address2'];
				$sub->address_3 = $v['input_data']['address3'];
				$sub->postcode = $v['input_data']['postcode'];
				$sub->city = $v['input_data']['city'];
				$sub->state = $v['input_data']['state'];
				$sub->country = $v['input_data']['country'];
				$sub->password = "password123";
				$sub->created_on = date('Y-m-d H:i:s');
				$sub->modified_on = date('Y-m-d H:i:s');
				$sub->save();
				$v['sub_name'] = $v['input_data']['name'];
				$v['sub_tel'] = $v['input_data']['tel'];
				$v['sub_email'] = $v['input_data']['email'];
				$address =	$v['input_data']['address1'] ."<br/>";
				$address .= !empty($v['input_data']['address2']) ? $v['input_data']['address2'] ."<br/>" : '';
				$address .= !empty($v['input_data']['address3']) ? $v['input_data']['address3'] ."<br/>" : '';
				$address .= $v['input_data']['postcode'] .", ".
										$v['input_data']['city'] ."<br/>".
										$v['input_data']['state'] .", ".
										$v['input_data']['country'] .".";
				$v['sub_address'] = $address;
				$v['input_data']['paypal_id'] = $box_theme->paypal_button_id;	
				$v['show_paypal_form'] = true;
				
				
				$user_sess->create($sub->id());
			}
		}

		$v['page'] = 'box_subscribe';
	}

	$app->render($page_template, $v);
}

// -- random password generator
function createRandomPassword() {
	$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
	srand((double)microtime()*1000000);
	$i = 0;
	$pass = '';

	while($i <= 7) {
		$num = rand() % 33;
		$tmp = substr($chars, $num, 1);
		$pass = $pass . $tmp;
		$i++;
	}
	return $pass;
}

