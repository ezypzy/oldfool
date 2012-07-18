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
    $box = ORM::for_table('boxfools')
        ->where('name', $box_name)
        ->where_gt('status_id', 1)
        ->find_one();

    if($box == false || !in_array($box_name, $valid_box_names)) {
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


$app->map('/:box_name/subscribe/', 'box_subscribe_process')->via('POST', 'GET');
function box_subscribe_process($box_name) {
	global $app, $db, $v, $page_template;
	
	$box = ORM::for_table('boxfools')
		->where('name', $box_name)
		->where_gt('status_id', 1)
		->find_one();
	
	$v['form_submit'] = false;
	$v['form_error'] = false;
	$v['box_name'] = $box_name;
	$v['page'] = 'box_subscribe';
	$v['box_description'] = $box->description;
	$v['box_hashtag'] = $box->hashtag;
	$v['box_price'] = $box->price;
	$v['box_paypal_button_id'] = $box->paypal_hosted_button_id;
	$v['show_paypal_form'] = false;

	if($box == false) {
		$v['page'] = 'error';
		$app->render('layout', $v);
	} else {
		
		if($_POST) {
			$v['form_submit'] = true;
			$v['input_data'] = $input = $_POST;
			$i = 0;

			foreach($input as $key => $value) {
				$v['form_error_'.$key] = '';
				if($key != 'submit' &&
					 $key != 'address2'	&&
					 $key != 'address3' &&
					 trim($value) == null) {
					$v['form_error_list'][$i] = array(
						'field' => $key, 
						'message' => $key.' is empty.'
					);
					$v['form_error_'.$key] = 'error';
					$v['form_error'] = true;
				}

				if($key == 'email' && $v['form_error'] == false) {
					if(!v::email($value)) {
						$v['form_error_list'][$i] = array(
							'field' => $key, 
							'message' => 'Email syntax in incorrect.'
						);
						$v['form_error_'.$key] = 'error';
						$v['form_error'] = true;
					}
				}
				$i++;
			}

			// -- store data in db and resirect to paypal
			if($v['form_error'] == false) {
				$sub = ORM::for_table('subscribers')->create();
				$sub->name = $_POST['name'];
				$sub->email = trim(strtolower($_POST['email']));
				$sub->tel = $_POST['tel'];
				$sub->address_1 = $_POST['address1'];
				$sub->address_2 = $_POST['address2'];
				$sub->address_3 = $_POST['address3'];
				$sub->postcode = $_POST['postcode'];
				$sub->city = $_POST['city'];
				$sub->state = $_POST['state'];
				$sub->country = $_POST['country'];
				$sub->password = sha1($_POST['password']);
				$sub->created_on = date('Y-m-d H:i:s');
				$sub->modified_on = date('Y-m-d H:i:s');
				if($sub->save()) {
					$v['sub_name'] = $sub->name;
					$v['sub_address'] = 
						$sub->address_1 .'<br/>'.
						$sub->address_2 .'<br/>'.
						$sub->address_3 .'<br/>'.
						$sub->postcode .', '.
						$sub->city .', '.
						$sub->state .', '.
						$sub->country .'. ';
					$v['show_paypal_form'] = true;	
				} else {
					$v['form_error_list'][$i] = array(
						'field' => 'database', 
						'message' => 'Database error, please try again'
					);
					$v['form_error_database'] = 'error';
					$v['form_error'] = true;
				}
			}
		}

		$app->render($page_template, $v);
	}

}



$app->get('/but-why/', 'order_cancel');
function order_cancel() {
	echo 'this is the but why page';
}
