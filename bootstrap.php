<?php
/**
 * Boxfool Web Bootstrap
 *
 * bootstrap.php
 **/

require_once 'vendor/Slim/Slim.php';
require_once 'vendor/Idiorm/idiorm.php';
require_once 'vendor/Kirby/kirby.php';
require_once 'vendor/Rain/rain.tpl.class.php';

require_once 'app/config.php';
require_once 'app/helpers/db.php';
require_once 'app/helpers/view.php';
require_once 'app/helpers/session.php';

//Custom libraries
require_once 'app/lib/breadcrumb.php';

// -- init database connection
$db = new Database();
$db->connect();

// -- init session

// -- init app
$app = new Slim(array(
    'view'              =>  new RainView(),
    'templates.path'    =>  '../views'
));

$bread  =   new Breadcrumb('/');
$crumb  =   $bread->generate();

// Change cache dir from "tmp" to "cache"
RainTPL::$cache_dir =   'cache';

// -- init the view data
$v = array(
    'base_url'      =>  c::get('base_url'),
    'crumb'         =>  $crumb,
    'breadcrumb'    =>  'breadcrumb',
    'is_home'       =>  false,
    'page'          =>  'blank',
    'tweetfools'    =>  'tweetfools',
    'window_title'  =>  'Discover Boxfools of Awesomeness Every Quarter'
);

function debug($args)
{
    echo '<pre>';
    print_r($args);
    echo '</pre>';
}

$base_template  =   'layout';
$page_template  =   'page';

$app->get('/', 'landing');
function landing()
{
    global $v, $app,$base_template;
    $v['page']    =   'landing';
    $v['is_home']   =   true;
		$v['form_error'] = false; // Newly added to prevent error
		$v['form_success'] = false; // Newly added to prevent error
    $app->render($base_template, $v);
}

$app->map('/newsletter/', 'newsletter')->via('POST', 'GET');
function newsletter()
{
	global $v, $app, $base_template;
	$v['page'] = 'landing';
	$v['is_home'] = true;
	$v['form_error'] = false;
	$v['form_success'] = false;
	$v['form_error_type']['null'] = false;
	$v['form_error_type']['syntax'] = false;
	$v['form_error_type']['duplication'] = false;
	$v['form_error_type']['database'] = false;

	if($app->request()->isPost()) {
		// check for valid email address
		$email = $app->request()->post('email');

		if($email == '') {
			$v['form_error'] = true;
			$v['form_error_type']['null'] = true;
		}	

		if(!v::email($email)) {
			$v['form_error'] = true;
			$v['form_error_type']['syntax'] = true; 
		}

		$e = ORM::for_table('emails')->where('email', $email)->find_one();
		if($e) {
			$v['form_error'] = true;
			$v['form_error_type']['duplication'] = true; 
		}

		if($v['form_error'] == false) {
			$e = ORM::for_table('emails')->create();
			$e->email = $email;
			$e->created_at = date('Y-m-d H:i:s');
			if($e->save()) {
				$v['form_success'] = true;
			} else {
				$v['form_error'] = true;
				$v['form_error_type']['database'] = true;
			}
		} 
	}
	
	$app->render($base_template, $v);
}

require 'app/routes/admin.php';
require 'app/routes/pages.php';
require 'app/routes/boxes.php';

$app->run();
