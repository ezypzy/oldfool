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
$app->get('/:name/', 'box_name_show');
function box_name_show($name, $s = '') {
	global $app, $v;
	$v['page'] = 'box_info';
	$app->render('layout', $v);	
}

// -- page for box subscribe
$app->get('/:name/subscribe/', 'box_subscribe');
function box_subscribe($name) {
	global $app, $v;
	$v['page'] = 'box_subscribe';
	$app->render('layout', $v);
}
