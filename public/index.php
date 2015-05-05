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
define('ASSETS', DIR . 'assets' . DIRECTORY_SEPARATOR);


/**
 * define app version
 */
define('VERSION', '0.0.0.1');

/**
 * Include constants
 */
require_once APP . 'config' . DIRECTORY_SEPARATOR . 'constants.inc.php';


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
 * Load Cache Assets
 */
\resource_manager\Concate_Files::Init();
\resource_manager\Concate_Files::MainJS();
\resource_manager\Concate_Files::JS();
\resource_manager\Concate_Files::Stylesheet();


/**
 * Start Core
 */
$core = new core();

global $core;

$core->Init();


$core->Build();