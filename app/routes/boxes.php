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
	global $app, $db, $v, $page_template;
	
	$box = ORM::for_table('boxfools')
		->where('name', $box_name)
		->where_gt('status', 1)
		->find_one();
	
	$v['form_submit'] = false;
	$v['form_error'] = false;
	$v['box_name'] = $box_name;
	$v['page'] = 'box_subscribe';
	$v['box_description'] = $box->description;
	$v['box_hashtag'] = $box->hashtag;
	$v['box_price'] = $box->price;

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
							'message' => $key.' Email syntax in incorrect.'
						);
						$v['form_error_'.$key] = 'error';
						$v['form_error'] = true;
					}
				}
				$i++;
			}

			// -- store data in db and resirect to paypal
			if($v('form_error' == false)) {
		
			}
		}

		$app->render($page_template, $v);
	}

}

