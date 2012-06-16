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
		$v['page'] = 'box_info';
		$app->render('layout', $v);
	}
}

// -- page for box subscribe
$app->get('/:box_name/subscribe/', 'box_subscribe');
function box_subscribe($box_name) {
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
		$v['page'] = 'box_subscribe';
		$app->render('layout', $v);
	}
}
