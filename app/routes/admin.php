<?php
/**
 * Admin controller
 *
 * app/routes/admin.php
 **/

$app->get('/adm/', 'admin');
function admin() {
	global $app, $v;
	// -- if logged in redirect to admin dashboard

	// -- else redirect to login
	$app->redirect(c::get('base_url') .'/adm/login');
}


// -- login into admin panel
$app->get('/adm/login/', 'admin_login');
function admin_login() {
	// -- if logged in then redirect to dashboard

	$v['window_title'] = 'Boxfool - admin';

	$app->render('admin/layout', $v);
}
