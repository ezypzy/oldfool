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
    'window_title'  =>  'Boxfool of awesomeness'
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
    $app->render($base_template, $v);
}

require 'app/routes/admin.php';
require 'app/routes/boxes.php';

$app->run();
