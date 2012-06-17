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
    global $app, $v;

    // verify that box name exist
    $box = ORM::for_table('boxfools')
        ->where('name', $box_name)
        ->where_gt('status', 1)
        ->find_one();

    if($box == false) {
        $v['page'] = 'error';
        $app->render('layout', $v);
    } else {
        $v['box_name'] = $box_name;
        $v['box_description'] = $box->description;
        $v['box_hashtag'] = $box->hashtag;
        $v['box_price'] = $box->price;
        $v['page'] = 'box_info';
        $app->render('layout', $v);
    }
}


$app->map('/:box_name/subscribe/', 'box_subscribe_process')->via('POST', 'GET');
function box_subscribe_process($box_name) {
	global $app, $db, $v;
	echo "postss";
	$box = ORM::for_table('boxfools')
		->where('name', $box_name)
		->where_gt('status', 1)
		->find_one();

	if($box == false) {
		$v['page'] = 'error';
		$app->render('layout', $v);
	} else {
		
		if($_POST) {
			echo 'wut wut';

			$input['name'] = $app->request()->post('name');
			$input['email'] = $app->request()->post('email');
			$input['address1'] = $app->request()->post('address1');
			$input['address2'] = $app->request()->post('address2');
			$input['address3'] = $app->request()->post('address3');
			$input['postcode'] =$app->request()->post('postcode');
			$input['city'] = $app->request()->post('city');
			$input['state'] = $app->request()->post('state');
			$input['country'] = $app->request()->post('country');

			foreach($input as $k => $v) {
			if($v == '') {
				$v['form_error_type'][$k] = true;
				$v['form_error_message'][$k] = 'Fields canot be empty';
				$v['form_error'] = true;
			}

			if($k == 'email') {
				if(!v::email($v)) {
					$v['form_error_type'][$k] = true;
					$v['form_error_message'][$k] = 'Email syntax error. Please check yout email.';
					$v['form_error'] = true;
				}
			}
		}

		}

		$v['form_error'] = false;
		$v['box_name'] = $box_name;
		$v['page'] = 'box_subscribe';
		$v['box_description'] = $box->description;
		$v['box_hashtag'] = $box->hashtag;
		$v['box_price'] = $box->price;
		$app->render('layout', $v);
	}

}

