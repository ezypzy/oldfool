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

// -- init session

// -- init app
$app = new Slim(array(
    'view' => new RainView(),
    'templates.path' => '../views'
));

// Change cache dir from "tmp" to "cache"
RainTPL::$cache_dir =   'cache';

// -- init the view data
$v = array(
    'base_url' => c::get('base_url'),
    'page'          => 'blank',
    'window_title' => 'Boxfool of awesomeness'
);

$app->get('/', 'landing');
function landing() {
    global $v, $app;
    //$v['page']  =   'test';
    $app->render('landing', $v);
}

require 'app/routes/boxes.php';

$app->run();
