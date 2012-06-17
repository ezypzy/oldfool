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

// -- init database connection
$db = new Database();
$db->connect();

// -- init session

// -- init app
$app = new Slim(array(
    'view'              =>  new RainView(),
    'templates.path'    =>  '../views'
));

// Change cache dir from "tmp" to "cache"
RainTPL::$cache_dir =   'cache';

// -- init the view data
$v = array(
    'base_url'      =>  c::get('base_url'),
    'breadcrumb'    =>  'breadcrumb',
    'page'          =>  'blank',
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
    $app->render($base_template, $v);
}

$app->get('/boxfools-of-:page', 'boxstarpage');
function boxstarpage($page)
{
    global $v, $app, $page_template;
    $v['page']  =   'boxfoolof'.$page;

    $app->render($page_template, $v);
}

require 'app/routes/admin.php';
require 'app/routes/boxes.php';

$app->run();
