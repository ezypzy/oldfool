<?php
/**
 * Admin controller
 *
 * app/routes/admin.php
 **/

$app->get('/adm/', 'admin');
function admin() {
	global $app, $db, $v;

	// -- if logged in redirect to admin dashboard
	$v['window_title'] = 'Boxfool - Admin Overlord Dashboard';
	$v['adm_page'] = 'admin/login';
	$app->render('admin/layout', $v);

	// -- else redirect to login
	$app->redirect(c::get('base_url') .'/adm/login');
}


// -- login into admin panel
$app->get('/adm/login/', 'admin_login');
function admin_login() {
	global $app, $db, $v;
	// -- if logged in then redirect to dashboard

	$v['window_title'] = 'Boxfool - Admin Overlord Login';
	$v['adm_page'] = 'admin/login';

	$app->render('admin/layout', $v);
}


$app->get('/adm/dashboard/', 'admin_dashboard');
function admin_dashboard() {
	global $app, $db, $v;

	$v['window_title'] = 'Boxfool - Admin Overlord Dashboard';
	$v['adm_page'] = 'admin/dashboard';

	$app->render('admin/layout', $v);
}


$app->get('/adm/boxes/', 'admin_boxes');
function admin_boxes() {
	global $app, $db, $v;
	// -- if logged in then redirect to dashboard

	$v['window_title'] = 'Boxfool - Admin Overlord Login';
	$v['adm_page'] = 'admin/boxes';

	$app->render('admin/layout', $v);
}





// -- add admin
$app->get('/adm/add/', 'admin_add');
function admin_add() {
	echo sha1('b0xst4rs');
}
