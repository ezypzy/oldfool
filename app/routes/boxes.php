<?php
/**
 * boxes controller
 *
 * app/routes/boxes.php
 **/

$app->get('/boxes/', 'boxes_list');
function boxes_list() {
	
}

$app->get('/box/:name/', 'box_name_show');
function box_name_show($name) {
	global $app, $v;
	print_r($name);
}
