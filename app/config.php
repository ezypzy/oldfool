<?php
/**
 * Application configuration settings
 *
 * app/config.php
 **/

// -- local developments settings
if($_SERVER['SERVER_NAME'] == 'localhost') {
	c::set('env', 'development');
	c::set('db.host', 'localhost');
	c::set('db.name', 'boxfooldb');
	c::set('db.user', 'root');
	c::set('db.pass', 'root');
	c::set('base_url', 'http://'. $_SERVER['SERVER_NAME'] .'/boxfool');
} 

// -- local development settings (jibone)
if($_SERVER['SERVER_NAME'] == 'boxfool.dev') {
	c::set('env', 'development');
	c::set('db.host', 'localhost');
	c::set('db.name', 'boxfooldb');
	c::set('db.user', 'root');
	c::set('db.pass', 'root');
	c::set('base_url', 'http://boxfool.dev');
}

// -- live production settings
else {
	c::set('env', 'production');
	c::set('db.host', 'localhose');
	c::set('db.name', 'chicky-dev');
	c::set('db.user', 'root');
	c::set('db.pass', '');
	c::set('base_url', 'http://boxfool.com');
}

