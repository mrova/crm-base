<?php

// Define application name
defined('APPLICATION_NAME')
	|| define('APPLICATION_NAME', (getenv('APPLICATION_NAME') ? getenv('APPLICATION_NAME') : 'default'));
	
// Define path to project directory
defined('PROJECT_PATH')
	|| define('PROJECT_PATH', realpath(dirname(__FILE__) . '/../'));

// Define path to application directory
defined('APPLICATION_PATH')
	|| define('APPLICATION_PATH', PROJECT_PATH . '/applications/' . APPLICATION_NAME);

// Define application environment
defined('APPLICATION_ENV')
	|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
	realpath(PROJECT_PATH . '/library'),
	get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
	APPLICATION_ENV,
	APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()
			->run();
