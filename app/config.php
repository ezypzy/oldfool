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
elseif($_SERVER['SERVER_NAME'] == 'boxfool.dev') {
	c::set('env', 'development');
	c::set('db.host', 'localhost');
	c::set('db.name', 'boxfool_db');
	c::set('db.user', 'root');
	c::set('db.pass', '');
	c::set('base_url', 'http://boxfool.dev');
}
elseif($_SERVER['SERVER_NAME'] == 'dev.boxfool.com') {
	c::set('env', 'development');
	c::set('db.host', 'localhost');
	c::set('db.name', 'boxfool');
	c::set('db.user', 'boxfool');
	c::set('db.pass', 'b0xst4rs');
	c::set('base_url', 'http://dev.boxfool.com');
}
// -- live production settings
else {
	c::set('env', 'production');
	c::set('db.host', 'localhost');
	c::set('db.name', 'boxfool');
	c::set('db.user', 'boxfool');
	c::set('db.pass', 'b0xst4rs');
	c::set('base_url', 'http://boxfool.com');
}

