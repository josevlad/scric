<?php
	//echo md5('123');
	//header('Content-Type: text/html; charset=ISO-8859-1');
	//header('Content-Type: text/html; charset=UTF-8');
	//ini_set('display_errors', 1);
	
	define('DS', DIRECTORY_SEPARATOR); 
	define('ROOT', realpath(dirname(__FILE__)) . DS ); 	
	define('APP_PATH', ROOT . DS . 'protected' . DS . 'app' . DS);
	
	try {
		require_once APP_PATH . 'App.php'; 
		require_once APP_PATH . 'Site.php'; 
		require_once APP_PATH . 'Config.php'; 
		require_once APP_PATH . 'Controller.php'; 
		require_once APP_PATH . 'Model.php'; 
		require_once APP_PATH . 'Request.php'; 
		require_once APP_PATH . 'Views.php'; 
		require_once APP_PATH . 'DataBase.php';
		require_once APP_PATH . 'Session.php'; 
		
		Session::init();
		Site::run(new Request);
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
	

?>
