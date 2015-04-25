<?php 

session_start();


define('SECRET_KEY', 'gT%47*OO23-2pp');
define('SESSION_TIMEOUT', 60);

define('ENVIRONMENT', 'development');


/**
 * define execute path
 */
define('DIR', __DIR__.DIRECTORY_SEPARATOR);

/**
 * define core path
 */
define('CORE', DIR . '..' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR);


/**
 * define core path
 */
define('APP', DIR . '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'project_manager' . DIRECTORY_SEPARATOR);


/**
 * define core path
 */
define('VENDOR', DIR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR);


/**
 * define core path
 */
define('BEBERLEI', DIR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'beberlei' . DIRECTORY_SEPARATOR);


/**
 * define app version
 */
define('VERSION', '0.0.0.1');

/**
 * Include class autoloader
 */
require_once CORE . 'auto' . DIRECTORY_SEPARATOR . 'class.loader.inc.php';
require_once VENDOR . 'autoload.php';


/**
 * Start session library
 */
$session = new lib\Session();

global $session;



/**
 * Start Core
 */
$core = new core();

global $core;

$core->Init();


$core->Build();