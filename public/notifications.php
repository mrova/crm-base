<?php

// Define path to project directory
defined('PROJECT_NAME')
	|| define('PROJECT_NAME', 'default');
	
// Define path to project directory
defined('PROJECT_PATH')
	|| define('PROJECT_PATH', realpath(dirname(__FILE__) . '/../'));

// Define path to application directory
defined('APPLICATION_PATH')
	|| define('APPLICATION_PATH', PROJECT_PATH . '/applications/' . PROJECT_NAME);

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

// bootstrap and retrieve the frontController resource
$front = $application->getBootstrap()
		->bootstrap('frontController')
		->getResource('frontController');

//Which part of the app we want to use?
$module     = 'mailing';
$controller = 'notifications';
$action     = 'list';
$options    = array();

//create the request
$request = new Core_Controller_Request_Simple($action, $controller, $module, $options);

// set front controller options to make everything operational from CLI
$front->setRequest($request)
		->setResponse(new Zend_Controller_Response_Cli())
		->setRouter(new Core_Controller_Router_Cli())
		->throwExceptions(true);

// lets bootstrap our application and enjoy!
$application->bootstrap()
		->run();
