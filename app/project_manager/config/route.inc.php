<?php

$route = [];

// each part between / count

$route['main.js']   = 'assets/main_js';
$route['script.js'] = 'assets/js';
$route['stylesheet.css'] = 'assets/css';

$route['image/([.A-Za-z0-9_-]+)/([.A-Za-z0-9_-]+)/([.A-Za-z0-9_-]+)'] = 'image/path/$1/$2/$3';
$route['image/([.A-Za-z0-9_-]+)/([.A-Za-z0-9_-]+)'] = 'image/index/$1/$2';


$route['my_dashboard/([.A-Za-z0-9_-]+)/([.A-Za-z0-9_-]+)'] = 'dashboard/mysetup/$1/$2';
$route['signout'] = 'logout';
$route['my_profile'] = 'profile';
$route['call'] = 'ajax_request';