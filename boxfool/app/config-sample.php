<?php
/**
 * Application configuration settings
 *
 * app/config.php
 **/

// -- edit this setting accordingly.
c::set('mode', 'development');
c::set('db.host', 'localhost');
c::set('db.name', 'boxfooldb');
c::set('db.user', 'root');
c::set('db.pass', 'root');

c::set('base_url', 'http://'. $_SERVER['SERVER_NAME']);

