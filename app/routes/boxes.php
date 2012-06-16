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
$app->get('/box/:name/', 'box_name_show');
function box_name_show($name, $s = '') {
	global $app, $v;
	print_r($name);
}

// -- page for box subscribe
$app->get('/box/:name/subscribe/', 'box_subscribe');
function box_subscribe($name) {
	global $app, $v;
	print_r($name);
	echo 'subscribe';
}
